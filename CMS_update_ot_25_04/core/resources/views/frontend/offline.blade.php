<!DOCTYPE HTML>
<!--

 ##################################################
 ##################################################
 ##################################################
 ##################################################
 ######             ############             ######    - SSSSSSSSSS...
 ######             ############             ######    - Это крипер и он взрывает мониторы
 ######             ############             ######
 ######             ############             ######
 ######             ############             ######
 ######             ############             ######
 ###################            ###################
 ###################            ###################
 ###################            ###################
 #############                         ############
 #############                         ############
 #############                         ############
 #############                         ############
 #############                         ############
 #############      ############       ############
 #############      ############       ############
 #############      ############       ############
 #############      ############       ############
 ##################################################
 ##################################################
 ##################################################
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 



































 
--->
<html lang="ru">
	<head>
		<meta charset="UTF-8">
	    <meta name="description" content="{{ $general->description }}">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
	    <!-- <link rel="shortcut icon" href="{{ asset('assets/frontend/img/icon.png?u=1') }}" type="image/x-icon"> -->
		<title>{{ $general->title }} - {{ $general->description }}</title>
		<meta name="robots" content="all,follow">
	    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="csrf-token" content="0" value="0">
	    <style>
	        @keyframes hidePreloader {
	            0% {
	                width: 100%;
	                height: 100%;
	            }

	            100% {
	                width: 0;
	                height: 0;
	            }
	        }
	        body > div.preloader {
	            position: fixed;
	            background: white;
	            width: 100%;
	            height: 100%;
	            z-index: 1071;
	            opacity: 0;
	            transition: opacity .5s ease;
	            overflow: hidden;
	            pointer-events: none;
	            display: flex;
	            align-items: center;
	            justify-content: center;
	        }
	        body:not(.loaded) > div.preloader {
	            opacity: 1;
	        }
	        body:not(.loaded) {
	            overflow: hidden;
	        }
	        body.loaded > div.preloader {
	            animation: hidePreloader .5s linear .5s forwards;
	        }
	    </style>
	    @include('frontend.layouts.styles')
		<script>
	        window.addEventListener("load", function() {
	            setTimeout(function() {
	                document.querySelector('body').classList.add('loaded');
	            }, 300);
	        });
	    </script>
		@include('frontend.layouts.scripts')
		<script type="text/javascript">
			var csrf_token = '{{ csrf_token() }}';
		</script>
	</head>
	<body style="max-height:inherit !important;">
		<div class="preloader">
		    <div class="spinner-border text-primary" role="status">
		        <span class="sr-only">Loading...</span>
		    </div>
		</div>
		
		<div id="content_show" class="slice pt-5 mt-5">
		    <div class="container position-relative zindex-100 pt-5 mt-5">
	            <div class="col-lg-12 mx-auto">
					<div class="card mb-3 p-4">
						<h6 style="text-transform:uppercase;">САЙТ ВРЕМЕННО НЕДОСТУПЕН</h6>
						<hr style="margin-top:0;margin-bottom:10px;">
				        В данный момент, на сайте ведутся технические работы. Приносим извинения за доставленные неудобства.
					</div>
	            </div>
		    </div>
		</div>
		<style type="text/css">
			html, body {
				height: 100%;
				background: url('{{ asset('assets/img') }}/bg.jpg') no-repeat 100% 100%, url('{{ asset('assets/img') }}/players.png') no-repeat 100% 100%;
			    background-size: cover;
			}
		</style>
	</body>
</html>