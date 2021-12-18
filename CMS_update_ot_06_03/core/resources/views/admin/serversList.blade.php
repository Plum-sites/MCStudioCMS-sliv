@extends('admin.layouts.master')
@section('page_icon', 'fa fa-server')
@section('page_name', 'Список серверов')
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12">
            <div class="tile-main">
                <div class="tile tile-smot">
                    <div class="tile-head">
                            <a style="text-transform:none;" class="btn btn-sm btn-success service_adds_btn mb-4" href="#" data-toggle="modal" data-target="#serverAdds">
                                <i class="fa fa-plus-circle"></i> Добавить сервер
                            </a>
                    </div>
                </div>
                <div class="tile">
                    <div class="table-responsive">
                        <table class="table w-100">
                            <tr>
                                <th style="min-width:45px;">ID</th>
                                <th style="min-width:135px;">СЕРВЕР</th>
                                <th style="min-width:195px;">ИГРОКОВ ОНЛАЙН</th>
                                <th style="min-width:165px;">РЕКОРД ОНЛАЙНА</th>
                                <th style="min-width:170px;"></th>
                            </tr>
                            @foreach($servers as $server)
                                <tr>
                                    <td style="font-size: 15px;">{{ @$server->id }}</td>
                                    <td style="font-size: 15px;">{{ @$server->name }}</td>
                                    <td style="font-size: 15px;">{{ @$server->online }} из {{ @$server->slots }} чел.</td>
                                    <td style="font-size: 15px;">{{ @$server->max_online }} чел.</td>
                                    <td>
                                        <form id="form_server_dels{{ @$server->id }}" role="form" action="{{ route('admin.serversList.adds') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ @$server->id }}">
                                            <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 15px;"
                                                    data-toggle="modal"
                                                    data-target="#server{{ @$server->id }}"
                                                    data-id="{{ @$server->id }}"
                                            >
                                                Изменить
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger server_dels" style="font-size: 15px;" data-id="{{ @$server->id }}">
                                                <i class="fa fa-trash" style="margin:0 2px;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ @$servers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="serverAdds" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold text-left text-black">Добавление сервера <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Для корректного подключения сервера к CMS необходимы плагины LiteBans, iConomy, ShoppingCart Reborn, PermissionsEx. Ненужные функции можно отключить в основных настройках сайта."></i></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_server_adds" role="form" action="{{ route('admin.serversList.adds') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="portlet light bordered">
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="">
                                                <b style="font-size: 16px;">Название сервера</b>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="name" class="form-control" placeholder="HiTech">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-server"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">
                                                <b style="font-size: 16px;">IP сервера</b>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="ip" class="form-control" placeholder="127.0.0.1">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-server"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">
                                                <b style="font-size: 16px;">PORT сервера</b>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="port" class="form-control" placeholder="25565">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-server"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL адрес</b></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_host" class="form-control" placeholder="localhost">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL порт </b><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="3306 по умолчанию"></i></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_port" class="form-control" placeholder="3306">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL пользователь</b></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_user" class="form-control" placeholder="root">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL название базы</b></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_base" class="form-control" placeholder="base">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL пароль</b></label>
                                            <div class="input-group">
                                                <input type="password" data-hover-view="password" name="mysql_pass" class="form-control" placeholder="67ik6kjfa">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL таблица LiteBans </b><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="На текущий момент поддерживается только LiteBans."></i></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_table_bans" class="form-control"  placeholder="litebans_bans">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL таблица iConomy</b></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_table_coin" class="form-control"  placeholder="iConomy">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL таблица ShoppingCart Reborn </b><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Через плагин выдаются предметы из магазина и привилегии через LuckPerms и PermissionsEx по API."></i></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_table_shop" class="form-control"  placeholder="purchases">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL таблица PermissionsEx (префиксы) </b><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Префиксы работают только через PermissionsEx."></i></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_table_pref" class="form-control"  placeholder="permissions">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="status" value="1" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Сервер активен" data-off="Сервер не активен" data-width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-block server_adds">
                            Сохранить
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach($servers as $server)
    <div class="modal fade" id="server{{ @$server->id }}" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold text-left text-black">Сервер {{ @$server->name }} <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Для корректного подключения сервера к CMS необходимы плагины LiteBans, iConomy, ShoppingCart Reborn, PermissionsEx. Ненужные функции можно отключить в основных настройках сайта."></i></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_server_{{ @$server->id }}" role="form" action="{{ route('admin.serversList.adds') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$server->id }}">
                    <div class="modal-body">
                        <div class="portlet light bordered">
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="">
                                                <b style="font-size: 16px;">Название сервера</b>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="name" class="form-control" value="{{ @$server->name }}" placeholder="HiTech">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-server"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">
                                                <b style="font-size: 16px;">IP сервера</b>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="ip" class="form-control" value="{{ @$server->ip }}" placeholder="127.0.0.1">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-server"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">
                                                <b style="font-size: 16px;">PORT сервера</b>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="port" class="form-control" value="{{ @$server->port }}" placeholder="25565">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-server"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL адрес</b></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_host" class="form-control" value="{{ @$server->mysql_host }}" placeholder="localhost">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL порт </b><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="3306 по умолчанию"></i></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_port" class="form-control" value="{{ @$server->mysql_port }}" placeholder="3306">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL пользователь</b></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_user" class="form-control" value="{{ @$server->mysql_user }}" placeholder="root">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL название базы</b></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_base" class="form-control" value="{{ @$server->mysql_base }}" placeholder="base">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL пароль</b></label>
                                            <div class="input-group">
                                                <input type="password" data-hover-view="password" name="mysql_pass" class="form-control" value="{{ @$server->mysql_pass }}" placeholder="67ik6kjfa">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL таблица LiteBans </b><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="На текущий момент поддерживается только LiteBans."></i></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_table_bans" class="form-control" value="{{ @$server->mysql_table_bans }}" placeholder="litebans_bans">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL таблица iConomy</b></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_table_coin" class="form-control" value="{{ @$server->mysql_table_coin }}" placeholder="iConomy">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL таблица ShoppingCart Reborn </b><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Через плагин выдаются предметы из магазина и привилегии через LuckPerms и PermissionsEx по API."></i></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_table_shop" class="form-control" value="{{ @$server->mysql_table_shop }}" placeholder="purchases">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for=""><b style="font-size: 16px;">MySQL таблица PermissionsEx (префиксы) </b><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Префиксы работают только через PermissionsEx."></i></label>
                                            <div class="input-group">
                                                <input type="text" name="mysql_table_pref" class="form-control" value="{{ @$server->mysql_table_pref }}" placeholder="permissions">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-cog"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="status" value="1" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Сервер активен" data-off="Сервер не активен" data-width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-block server_save" data-id="{{ @$server->id }}">
                            Сохранить
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    <script type="text/javascript">

        $('.server_save').on('click', function() {
            var id = $(this).data('id');
            $(this).attr('disabled', true);
            var form = $('#form_server_' + id)[0];
            var form_data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{ route('admin.serversList.save') }}",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data) {
                    notify(data.message, 8000, data.type);
                    $('.server_save').attr('disabled', false);
                    if(data.type == "success") {
                        setTimeout(function() {
                            document.location.reload();
                        }, 2000);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('.server_save').attr('disabled', false);
                }
            });
        });
        $('.server_adds').on('click', function() {
            $(this).attr('disabled', true);
            var form = $('#form_server_adds')[0];
            var form_data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{ route('admin.serversList.adds') }}",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data) {
                    notify(data.message, 8000, data.type);
                    $('.server_adds').attr('disabled', false);
                    if(data.type == "success") {
                        setTimeout(function() {
                            document.location.reload();
                        }, 2000);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('.server_adds').attr('disabled', false);
                }
            });
        });
        $('.server_dels').on('click', function() {
            var id = $(this).data('id');
            $(this).attr('disabled', true);
            var form = $('#form_server_dels' + id)[0];
            var form_data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{ route('admin.serversList.dels') }}",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data) {
                    notify(data.message, 8000, data.type);
                    $('.server_dels').attr('disabled', false);
                    if(data.type == "success") {
                        setTimeout(function() {
                            document.location.reload();
                        }, 2000);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('.server_dels').attr('disabled', false);
                }
            });
        });
    </script>
@endsection