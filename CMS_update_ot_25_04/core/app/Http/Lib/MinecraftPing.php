<?php

namespace App\Http\Lib;

class MinecraftPing
{
	/*
	 * Queries Minecraft server
	 * Returns array on success, false on failure.
	 *
	 * WARNING: This method was added in snapshot 13w41a (Minecraft 1.7)
	 *
	 * Written by xPaw
	 *
	 * Website: http://xpaw.me
	 * GitHub: https://github.com/xPaw/PHP-Minecraft-Query
	 *
	 * ---------
	 *
	 * This method can be used to get server-icon.png too.
	 * Something like this:
	 *
	 * $Server = new MinecraftPing( 'localhost' );
	 * $Info = $Server->Query();
	 * echo '<img width="64" height="64" src="' . Str_Replace( "\n", "", $Info[ 'favicon' ] ) . '">';
	 *
	 */

	private $socket;
	private $host;
	private $port;
	private $timeout;

	public function __construct( $Address, $port = 25565, $timeout = 3, $ResolveSRV = true )
	{
		$this->host = $Address;
		$this->port = (int)$port;
		$this->timeout = (int)$timeout;

		if( $ResolveSRV )
		{
			$this->ResolveSRV();
		}

		$this->Connect( );
	}

	public function __destruct( )
	{
		$this->Close( );
	}

	public function Close( )
	{
		if( $this->Socket !== null )
		{
			fclose( $this->Socket );

			$this->Socket = null;
		}
	}

	public function Connect( )
	{
		$connecttimeout = $this->timeout;
		$this->Socket = @fsockopen( $this->host, $this->port, $errno, $errstr, $connecttimeout );

		if( !$this->Socket )
		{
			$this->Socket = null;
			
			return false;
		}

		// Set Read/Write timeout
		stream_set_timeout( $this->Socket, $this->timeout );

		return true;
	}

	public function Query( )
	{
		$TimeStart = microtime(true); // for read timeout purposes

		// See http://wiki.vg/Protocol (Status Ping)
		$Data = "\x00"; // packet ID = 0 (varint)

		$Data .= "\x04"; // Protocol version (varint)
		$Data .= Pack( 'c', StrLen( $this->host ) ) . $this->host; // Server (varint len + UTF-8 addr)
		$Data .= Pack( 'n', $this->port ); // Server port (unsigned short)
		$Data .= "\x01"; // Next state: status (varint)

		$Data = Pack( 'c', StrLen( $Data ) ) . $Data; // prepend length of packet ID + data

		fwrite( $this->Socket, $Data ); // handshake
		fwrite( $this->Socket, "\x01\x00" ); // status ping

		$Length = $this->ReadVarInt( ); // full packet length

		if( $Length < 10 )
		{
			return FALSE;
		}

		$this->ReadVarInt( ); // packet type, in server ping it's 0

		$Length = $this->ReadVarInt( ); // string length

		$Data = "";
		do
		{
			if (microtime(true) - $TimeStart > $this->timeout)
			{
				throw new MinecraftPingException( 'Server read timed out' );
			}

			$Remainder = $Length - StrLen( $Data );
			$block = fread( $this->Socket, $Remainder ); // and finally the json string
			// abort if there is no progress
			if (!$block)
			{
				throw new MinecraftPingException( 'Server returned too few data' );
			}

			$Data .= $block;
		} while( StrLen($Data) < $Length );

		if( $Data === FALSE )
		{
			throw new MinecraftPingException( 'Server didn\'t return any data' );
		}

		$Data = JSON_Decode( $Data, true );

		if( JSON_Last_Error( ) !== JSON_ERROR_NONE )
		{
			if( Function_Exists( 'json_last_error_msg' ) )
			{
				throw new MinecraftPingException( JSON_Last_Error_Msg( ) );
			}
			else
			{
				throw new MinecraftPingException( 'JSON parsing failed' );
			}

			return FALSE;
		}

		return $Data;
	}

	public function QueryOldPre17( )
	{
		fwrite( $this->Socket, "\xFE\x01" );
		$Data = fread( $this->Socket, 512 );
		$Len = StrLen( $Data );

		if( $Len < 4 || $Data[ 0 ] !== "\xFF" )
		{
			return FALSE;
		}

		$Data = SubStr( $Data, 3 ); // Strip packet header (kick message packet and short length)
		$Data = iconv( 'UTF-16BE', 'UTF-8', $Data );

		// Are we dealing with Minecraft 1.4+ server?
		if( $Data[ 1 ] === "\xA7" && $Data[ 2 ] === "\x31" )
		{
			$Data = Explode( "\x00", $Data );

			return Array(
				'HostName'   => $Data[ 3 ],
				'Players'    => IntVal( $Data[ 4 ] ),
				'MaxPlayers' => IntVal( $Data[ 5 ] ),
				'Protocol'   => IntVal( $Data[ 1 ] ),
				'Version'    => $Data[ 2 ]
			);
		}

		$Data = Explode( "\xA7", $Data );

		return Array(
			'HostName'   => SubStr( $Data[ 0 ], 0, -1 ),
			'Players'    => isset( $Data[ 1 ] ) ? IntVal( $Data[ 1 ] ) : 0,
			'MaxPlayers' => isset( $Data[ 2 ] ) ? IntVal( $Data[ 2 ] ) : 0,
			'Protocol'   => 0,
			'Version'    => '1.3'
		);
	}

	private function ReadVarInt( )
	{
		$i = 0;
		$j = 0;

		while( true )
		{
			$k = @fgetc( $this->Socket );

			if( $k === FALSE )
			{
				return 0;
			}

			$k = Ord( $k );

			$i |= ( $k & 0x7F ) << $j++ * 7;

			if( $j > 5 )
			{
				throw new MinecraftPingException( 'VarInt too big' );
			}

			if( ( $k & 0x80 ) != 128 )
			{
				break;
			}
		}

		return $i;
	}

	private function ResolveSRV()
	{
		if( ip2long( $this->host ) !== false )
		{
			return;
		}

		$Record = @dns_get_record( '_minecraft._tcp.' . $this->host, DNS_SRV );

		if( empty( $Record ) )
		{
			return;
		}

		if( isset( $Record[ 0 ][ 'target' ] ) )
		{
			$this->host = $Record[ 0 ][ 'target' ];
		}

		if( isset( $Record[ 0 ][ 'port' ] ) )
		{
			$this->port = $Record[ 0 ][ 'port' ];
		}
	}
}
