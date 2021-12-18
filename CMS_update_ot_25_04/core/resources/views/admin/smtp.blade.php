@extends('admin.layouts.master')
@section('page_icon', 'fa fa-cogs')
@section('page_name', 'Настройки SMTP')
@section('body')
<div class="row">
    @include('admin.layouts.flash')
    <div class="col-md-12">
        <div class="tile-main">
            <div class="tile tile-smot">
                <div class="tile-head">

                </div>
            </div>
            <div class="tile">
                <form method="post" action="{{ route('admin.smtp.save')}}">
                    @csrf
                    <div class="tile-body">
                        <h5>Настройки отправки писем</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>SMTP хост</b></label>
                                    <input class="form-control" type="text" name="mail_host" id="mail_host" value="{{ Config::get('mail.host') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Шифрование SSL/TSL/none</b></label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="mail_encryption" id="mail_encryption" value="{{ env('MAIL_ENCRYPTION') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>SMTP порт</b></label>
                                    <input class="form-control" type="text" name="description" name="mail_port" id="mail_port" value="{{ env('MAIL_PORT') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Почта</b></label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="mail_username" id="mail_username" value="{{ env('MAIL_USERNAME') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Пароль</b></label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="mail_password" id="mail_password" value="{{ env('MAIL_PASSWORD') }}">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-outline-primary btn-block" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i> Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
/*@media (min-width: 900px) {
    .toggle-on {
        line-height: 21px !important;
    }
    .toggle-off {
        line-height: 21px !important;
    }
}*/
</style>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#sw_exchange').val( {!! @$item->sw_exchange !!} ); 
        $('#sw_ratings').val( {!! @$item->sw_ratings !!} ); 
        $('#sw_banlist').val( {!! @$item->sw_banlist !!} ); 
        $('#sw_kits').val( {!! @$item->sw_kits !!} ); 
        $('#sw_prefixes').val( {!! @$item->sw_prefixes !!} ); 
        $('#sw_shop').val( {!! @$item->sw_shop !!} ); 
    });

    $('#sw_exchange').change(function() {
        $('#sw_exchange').val($(this).is(':checked')); 
    });

    $('#sw_ratings').change(function() {
        $('#sw_ratings').val($(this).is(':checked')); 
    });

    $('#sw_banlist').change(function() {
        $('#sw_banlist').val($(this).is(':checked')); 
    });

    $('#sw_kits').change(function() {
        $('#sw_kits').val($(this).is(':checked')); 
    });

    $('#sw_prefixes').change(function() {
        $('#sw_prefixes').val($(this).is(':checked')); 
    });

    $('#sw_shop').change(function() {
        $('#sw_shop').val($(this).is(':checked')); 
    });

    function alert_exch() {
        if($('#exch_rubs_to_coin').val() == '') {
            $('#exch_rubs_to_coin').val('');
            $('#sum_pays_x').html('0');
        } else if($('#exch_rubs_to_coin').val() < 1) {
            $('#exch_rubs_to_coin').val('');
        } else if($('#exch_rubs_to_coin').val() > 10000) {
            $('#exch_rubs_to_coin').val('10000');
        }
        var exch_rubs_to_coin = (!$('#exch_rubs_to_coin').val()) ? 0 : $('#exch_rubs_to_coin').val();
        var multiply = 2 * exch_rubs_to_coin;
        $('#sum_pays_x').html(multiply);
    }
    $(document).on('change', '#exch_rubs_to_coin', function () {
        alert_exch();
    });
    $(document).on('keyup', '#exch_rubs_to_coin', function () {
        alert_exch();
    });
    alert_exch();



    $(document).ready(function () {
        $('#color').spectrum({
            color: $('#color').val(),
            change: function (color) {
                $('#colorValue').val(color.toHexString().slice(1));
            }
        });
        bkLib.onDomLoaded(function () {
            nicEditors.allTextAreas()
        });

        $(document).ready(function () {
            $(document).on('keyup', '#currency_symbol', function () {
                var val = $(this).val();
                $('#currency_rate').text(val)
            });
        });
    });
</script>
@endsection