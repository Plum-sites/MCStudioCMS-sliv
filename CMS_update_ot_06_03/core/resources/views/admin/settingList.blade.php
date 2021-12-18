@extends('admin.layouts.master')
@section('page_icon', 'fa fa-cogs')
@section('page_name', 'Настройка сайта')
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
                <form method="post" action="{{ route('admin.settingList.save')}}">
                    @csrf
                    <div class="tile-body">
                        <h5>Основные настройки сайта</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>Заголовок сайта</b></label>
                                    <input class="form-control" type="text" name="title" value="{{ @$item->title }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>Описание сайта</b></label>
                                    <input class="form-control" type="text" name="description" value="{{ @$item->description }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>Почта отправки писем</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="text-transform:uppercase;">
                                                @
                                            </span>
                                        </div>
                                        <input class="form-control" type="text" name="e_sender" id="e_sender" value="{{ @$item->e_sender }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>Название реальной валюты</b></label>
                                    <input type="text" class="form-control" value="{{ @$item->currency_symbol }}" name="currency_symbol">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>Название игровой валюты</b></label>
                                    <input type="text" class="form-control" value="{{ @$item->game_symbol }}" name="game_symbol" id="game_symbol">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>Курс игровой валюты</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="text-transform:uppercase;">
                                                2 {{ @$item->currency_symbol }} *
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" value="{{ @$item->exch_rubs_to_coin }}" id="exch_rubs_to_coin" name="exch_rubs_to_coin" style="text-align:center;">
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="text-transform:uppercase;">
                                                =&nbsp;<span id="sum_pays_x"></span>&nbsp;{{ @$item->game_symbol }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>Регистрация пользователей</b></label>
                                    <select class="form-control select-max-width font-size-for-mobile-17" id="reg" name="reg">
                                        <option value="1" {{ (@$item->reg == 1) ? 'selected' : '' }}>Включена</option>
                                        <option value="0" {{ (@$item->reg == 0) ? 'selected' : '' }}>Выключена</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>Используемый шлюз платежей</b></label>
                                    <select class="form-control select-max-width font-size-for-mobile-17" id="gateway_use" name="gateway_use">
                                        <option value="" selected disabled>Выберите используемый шлюз</option>
                                        <option value="0" {{ (@$item->gateway_use == 0) ? 'selected' : '' }}>Выключить пополнение баланса</option>
                                        @foreach($gateways as $key => $gateway)
                                        @php
                                        $gateway_row = $gateway->gateway();
                                        @endphp
                                        <option value="{{ @$key }}" {{ (@$item->gateway_use == @$key) ? 'selected' : '' }}>Шлюз {{ @$gateway_row->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>E-Mail уведомления</b></label>
                                    <select class="form-control select-max-width font-size-for-mobile-17" id="email_notification" name="email_notification">
                                        <option value="1" {{ (@$item->email_notification == 1) ? 'selected' : '' }}>Включены</option>
                                        <option value="0" {{ (@$item->email_notification == 0) ? 'selected' : '' }}>Выключены</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>Команда выдачи префикса</b></label>
                                    <input type="text" class="form-control" placeholder="pex user %player% set prefix %prefix%" value="{{ @$item->prefix_cmd }}" name="prefix_cmd" data-toggle="tooltips" data-placement="top" data-html="true" title="<b>%player% - подставляется ник игрока<br><b>%prefix%</b> - подставляется префикс игрока">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>Offline режим</b></label>
                                    <select class="form-control select-max-width font-size-for-mobile-17" id="site_offline" name="site_offline">
                                        <option value="1" {{ (@$item->site_offline == 1) ? 'selected' : '' }}>Включить</option>
                                        <option value="0" {{ (@$item->site_offline == 0) ? 'selected' : '' }}>Выключить</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h5>Ссылки на скачивание лаунчера</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Ссылка на лаунчер для Windows</b></label>
                                    <input type="text" class="form-control" placeholder="https://{{ $_SERVER['SERVER_NAME'] }}/launcher.exe" value="{{ @$item->launcher_link }}" name="launcher_link">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Ссылка на лаунчер для Mac OS X</b></label>
                                    <input type="text" class="form-control" placeholder="https://{{ $_SERVER['SERVER_NAME'] }}/launcher.jar" value="{{ @$item->launcher_link_jar }}" name="launcher_link_jar">
                                </div>
                            </div>
                        </div>  
                        <h5>Настройки интеграции с VK</h5>
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>[VK] ID приложения</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ @$item->vk_client_id }}" name="vk_client_id">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>[VK] Защищённый ключ</b></label>
                                    <div class="input-group">
                                        <input type="password" data-hover-view="password" class="form-control" value="{{ @$item->vk_client_secret }}" id="vk_client_secret" name="vk_client_secret">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>[VK] Доверенный redirect URI</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ @$item->vk_redirect_uri }}" name="vk_redirect_uri" placeholder="https://your-site.ru/login/vk/auth">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>[VK] ID сообщества</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ @$item->vk_group_id }}" name="vk_group_id">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>[VK] Сервисный ключ доступа</b></label>
                                    <div class="input-group">
                                        <input type="password" data-hover-view="password" class="form-control" value="{{ @$item->vk_group_token }}" id="vk_group_token" name="vk_group_token">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>[VK] Кол-во получаемых новостей</b></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" value="{{ @$item->vk_output_count }}" id="vk_output_count" name="vk_output_count">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5>Настройки интеграции с Discord <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Если виджет не отображает информацию, включите его в настройках сервера Discord"></i></h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>[Discord] ID сервера для виджета</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ @$item->discord_server_id }}" placeholder="33473737" id="discord_server_id" name="discord_server_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5>Включение/отключение функций</h5>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input checked" id="sw_exchange" name="sw_exchange" value="{{ @$item->sw_exchange }}" @if(@$item->sw_exchange == 'true') checked @endif>
                                    <label class="custom-control-label" for="sw_exchange">Обмен валюты</label>
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="sw_ratings" name="sw_ratings" value="{{ @$item->sw_ratings }}" @if(@$item->sw_ratings == 'true') checked @endif>
                                    <label class="custom-control-label" for="sw_ratings">Голосования</label>
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="sw_banlist" name="sw_banlist" value="{{ @$item->sw_banlist }}" @if(@$item->sw_banlist == 'true') checked @endif>
                                    <label class="custom-control-label" for="sw_banlist">Банлист</label>
                                  </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="sw_kits" name="sw_kits" value="{{ @$item->sw_kits }}" @if(@$item->sw_kits == 'true') checked @endif>
                                    <label class="custom-control-label" for="sw_kits">Наборы</label>
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="sw_prefixes" name="sw_prefixes" value="{{ @$item->sw_prefixes }}" @if(@$item->sw_prefixes == 'true') checked @endif>
                                    <label class="custom-control-label" for="sw_prefixes">Префиксы</label>
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="sw_shop" name="sw_shop" value="{{ @$item->sw_shop }}" @if(@$item->sw_shop == 'true') checked @endif>
                                    <label class="custom-control-label" for="sw_shop">Магазин блоков</label>
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