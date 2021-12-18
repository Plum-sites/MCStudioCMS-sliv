@extends('admin.layouts.master')
@section('page_icon', 'fa fa-cogs')
@section('page_name', 'Настройка шлюзов')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="tile-main">
            <div class="tile tile-smot">
                <div class="tile-head">

                </div>
            </div>
            @include('admin.layouts.flash')
            @if(@$gateways_list[1]->id)
            <div class="tile">
                <div class="col-md-6 float-left">
                    <div class="tile">
                        <div style="font-size:15pt;text-transform:uppercase;font-weight:bold;margin-bottom:-7px;">
                            {{ @$gateways_list[1]->name }}
                        </div>
                        <hr>
                        <form id="gateway_form_1" method="post" action="#" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="1">
                            <div class="tile-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="gateway_name" name="gateway_name" value="{{ @$gateways_list[1]->name }}"
                                                placeholder="Краткое название"
                                            >
                                            <span class="help-text-name text-danger"></span>
                                        </div>
                                        --->
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="fullname" name="fullname" value="{{ @$gateways_list[1]->fullname }}"
                                                placeholder="Полное название"
                                            >
                                            <span class="help-text-name text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="description" name="description" value="{{ @$gateways_list[1]->description }}"
                                                placeholder="Описание платежа"
                                            >
                                            <span class="help-text-url text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="link" name="link" value="{{ @$gateways_list[1]->link }}"
                                                placeholder="Редирект ссылка"
                                            >
                                            <small>Если у Вас ИП или ООО, замените .money на .ru</small>
                                            <span class="help-text-url text-danger"></span>
                                        </div>
                                        <div class="col-md-12 p-0 mb-4">
                                            <div class="form-group col-md-6 float-left p-0 pl-0 pr-1">
                                                <label class="control-label"><b>Публичный ключ</b></label>
                                                <input class="form-control" type="password" data-hover-view="password" id="key_public" name="key_public" value="{{ @$gateways_list[1]->key_public }}"
                                                    placeholder="Публичный ключ #1"
                                                >
                                                <span class="help-text-apikey text-danger"></span>
                                            </div>
                                            <div class="form-group col-md-6 float-left p-0 pl-1 pr-0">
                                                <label class="control-label"><b>Секретный ключ</b></label>
                                                    <input class="form-control" type="password" data-hover-view="password" id="key_secret" name="key_secret" value="{{ @$gateways_list[1]->key_secret }}"
                                                    placeholder="Секретный ключ #2"
                                                >
                                                <span class="help-text-apiusr text-danger"></span>
                                            </div>
                                            <small>В настройках проекта Unitpay укажите ссылку на обработчик https://{{ $_SERVER['SERVER_NAME'] }}/payments/unitpay</small>
                                        </div>
                                        
                                        
                                        <!-- <div class="form-group">
                                             <input name="status"
                                                data-toggle="toggle"
                                                data-onstyle="success"
                                                data-offstyle="danger"
                                                data-off="Выключен"
                                                data-on="Включен"
                                                data-width="100%" type="checkbox" value="1"
                                                {{ @$gateways_list[1]->status == "1" ? 'checked' : '' }}
                                            />
                                        </div> -->
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="tile-footer">
                            <button type="button" onclick="gatewaySaver(this);" value="1" class="btn btn-outline-primary col-md-12">
                                Сохранить
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                @if(@$gateways_list[2]->id)
                <div class="col-md-6 float-left">
                    <div class="tile">
                        <div style="font-size:15pt;text-transform:uppercase;font-weight:bold;margin-bottom:-7px;">
                            {{ @$gateways_list[2]->name }}
                        </div>
                        <hr>
                        <form id="gateway_form_2" method="post" action="#" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="2">
                            <div class="tile-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!---
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="gateway_name" name="gateway_name" value="{{ @$gateways_list[2]->name }}"
                                                placeholder="Краткое название"
                                            >
                                            <span class="help-text-name text-danger"></span>
                                        </div>
                                        --->
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="fullname" name="fullname" value="{{ @$gateways_list[2]->fullname }}"
                                                placeholder="Полное название"
                                            >
                                            <span class="help-text-name text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="description" name="description" value="{{ @$gateways_list[2]->description }}"
                                                placeholder="Описание платежа"
                                            >
                                            <span class="help-text-url text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="link" name="link" value="{{ @$gateways_list[2]->link }}"
                                                placeholder="Редирект ссылка"
                                            >
                                            <span class="help-text-url text-danger"></span>
                                            <small>Не меняйте эту ссылку</small>
                                        </div>
                                        <div class="col-md-12 p-0 mb-4">
                                            <div class="form-group col-md-4 float-left p-0 pl-0 pr-1">
                                                <label class="control-label"><b>ID магазина</b></label>
                                                <input class="form-control" type="text" id="store_id" name="store_id" value="{{ @$gateways_list[2]->store_id }}"
                                                    placeholder="ID магазина"
                                                >
                                                <span class="help-text-apikey text-danger"></span>
                                            </div>
                                            <div class="form-group col-md-4 float-left p-0 pl-0 pr-1">
                                                <label class="control-label"><b>Публичный ключ</b></label>
                                                <input class="form-control" type="password" data-hover-view="password" id="key_public" name="key_public" value="{{ @$gateways_list[2]->key_public }}"
                                                    placeholder="Публичный ключ #1"
                                                >
                                                <span class="help-text-apikey text-danger"></span>
                                            </div>
                                            <div class="form-group col-md-4 float-left p-0 pl-1 pr-0">
                                                <label class="control-label"><b>Секретный ключ</b></label>
                                                <input class="form-control" type="password" data-hover-view="password" id="key_secret" name="key_secret" value="{{ @$gateways_list[2]->key_secret }}"
                                                    placeholder="Секретный ключ #2"
                                                >
                                                <span class="help-text-apiusr text-danger"></span>
                                            </div>
                                            <small>В настройках кассы Freekassa укажите ссылку на обработчик https://{{ $_SERVER['SERVER_NAME'] }}/payments/freekassa</small>

                                        </div>
                                        
                                        <!-- <div class="form-group">
                                             <input name="status"
                                                data-toggle="toggle"
                                                data-onstyle="success"
                                                data-offstyle="danger"
                                                data-off="Выключен"
                                                data-on="Включен"
                                                data-width="100%" type="checkbox" value="1"
                                                {{ @$gateways_list[2]->status == "1" ? 'checked' : '' }}
                                            />
                                        </div> -->
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="tile-footer">
                            <button type="button" onclick="gatewaySaver(this);" value="2" class="btn btn-outline-primary col-md-12">
                                Сохранить
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                <div style="clear:both;"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function gatewaySaver(element) {
        var gateway_id = $(element).val();
        var gateway_form = $('#gateway_form_' + gateway_id)[0];
        var gateway_data = new FormData(gateway_form);
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.gatewaysList.save') }}',
            data: gateway_data,
            contentType: false,
            processData: false,
            success: function(data) {
                notify(data.message, 8000, data.type);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

</script>
<style>
    .api-display-active {
        color: #FFF;
        background-color: #00635a;
        border-color: #00564e;
    }
</style>
@endsection
