@extends('admin.layouts.master')
@section('page_icon', 'fa fa-users')
@section('page_name', ' Пользователь ')
@section('body')
<div class="row">
    @include('admin.layouts.flash')
    <div class="col-md-12">
        <div class="tile-main">
            <div class="tile tile-smot">
                <div class="tile-head">
                        <h2 class="mb-2">{{ @$user->username }}</h2>
                </div>
            </div>
            <div class="tile">
                <div class="tile-body">
                    <div class="row my-2">
                        <div class="col-lg-2 order-lg-1 text-center">
                            <!-- <img src="/view.php?user={{ (!@$user->username) ? 'default' : @$user->username }}&mode=3&size=175" class="mx-auto img-fluid img-circle d-block" alt="avatar"> -->
                            <!-- <span class="badge badge-info w-100"><i class="fa fa-user"></i> {{ @$user->username}}</span> -->
                            @if(@$user->auth_at+300 >= time())
                            <!-- <span class="badge badge-success w-100"><i class="fa fa-power-off"></i> Онлайн</span> -->
                            @else
                            <!-- <span class="badge badge-danger w-100"><i class="fa fa-power-off"></i> Оффлайн</span> -->
                            @endif
                            <div id="skin-data-mouse jus" style="vertical-align:top;">
                                <style class="skin-viewer-css" type="text/css">
                                    .skin-viewer *{ background-image: url('{{ @$file_skin }}'); }
                                    .skin-viewer .cape{ background-image: url('{{ @$file_cloak }}'); }
                                </style>
                                <div class="skin-viewer mc-skin-viewer-9x legacy legacy-cape spin waving" style="margin-bottom:15px;margin-top:50px;">
                                    <div class="player">
                                        <div class="head">
                                            <div class="top"></div>
                                            <div class="left"></div>
                                            <div class="front"></div>
                                            <div class="right"></div>
                                            <div class="back"></div>
                                            <div class="bottom"></div>
                                            <div class="accessory">
                                                <div class="top"></div>
                                                <div class="left"></div>
                                                <div class="front"></div>
                                                <div class="right"></div>
                                                <div class="back"></div>
                                                <div class="bottom"></div>
                                            </div>
                                        </div>
                                        <div class="body">
                                            <div class="top"></div>
                                            <div class="left"></div>
                                            <div class="front"></div>
                                            <div class="right"></div>
                                            <div class="back"></div>
                                            <div class="bottom"></div>
                                            <div class="accessory">
                                                <div class="top"></div>
                                                <div class="left"></div>
                                                <div class="front"></div>
                                                <div class="right"></div>
                                                <div class="back"></div>
                                                <div class="bottom"></div>
                                            </div>
                                        </div>
                                        <div class="left-arm">
                                            <div class="top"></div>
                                            <div class="left"></div>
                                            <div class="front"></div>
                                            <div class="right"></div>
                                            <div class="back"></div>
                                            <div class="bottom"></div>
                                            <div class="accessory">
                                                <div class="top"></div>
                                                <div class="left"></div>
                                                <div class="front"></div>
                                                <div class="right"></div>
                                                <div class="back"></div>
                                                <div class="bottom"></div>
                                            </div>
                                        </div>
                                        <div class="right-arm">
                                            <div class="top"></div>
                                            <div class="left"></div>
                                            <div class="front"></div>
                                            <div class="right"></div>
                                            <div class="back"></div>
                                            <div class="bottom"></div>
                                            <div class="accessory">
                                                <div class="top"></div>
                                                <div class="left"></div>
                                                <div class="front"></div>
                                                <div class="right"></div>
                                                <div class="back"></div>
                                                <div class="bottom"></div>
                                            </div>
                                        </div>
                                        <div class="left-leg">
                                            <div class="top"></div>
                                            <div class="left"></div>
                                            <div class="front"></div>
                                            <div class="right"></div>
                                            <div class="back"></div>
                                            <div class="bottom"></div>
                                            <div class="accessory">
                                                <div class="top"></div>
                                                <div class="left"></div>
                                                <div class="front"></div>
                                                <div class="right"></div>
                                                <div class="back"></div>
                                                <div class="bottom"></div>
                                            </div>
                                        </div>
                                        <div class="right-leg">
                                            <div class="top"></div>
                                            <div class="left"></div>
                                            <div class="front"></div>
                                            <div class="right"></div>
                                            <div class="back"></div>
                                            <div class="bottom"></div>
                                            <div class="accessory">
                                                <div class="top"></div>
                                                <div class="left"></div>
                                                <div class="front"></div>
                                                <div class="right"></div>
                                                <div class="back"></div>
                                                <div class="bottom"></div>
                                            </div>
                                        </div>
                                        <div class="cape">
                                            <div class="top"></div>
                                            <div class="left"></div>
                                            <div class="front"></div>
                                            <div class="right"></div>
                                            <div class="back"></div>
                                            <div class="bottom"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <form id="form" method="POST" action="{{route('admin.usersList.user.view', $user->id)}}" class="w-100" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="col-md-12 mt-4">
                                        <button type="submit" name="skin" value="skin" class="btn btn-outline-danger btn-block mb-2">
                                            Удалить скин
                                        </button>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" name="cloak" value="skin" class="btn btn-outline-danger btn-block">
                                            Удалить плащ
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-10 order-lg-2">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Информация</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Изменить</a>
                                </li>
                            </ul>
                            <div class="tab-content py-4">
                                <div class="tab-pane active" id="profile">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr style="background-color:rgba(0, 0, 0, 0.075);">
                                                            <th class="w-100" colspan="2" style="text-transform:uppercase;">
                                                                ДАННЫЕ ПОЛЬЗОВАТЕЛЯ
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="table-responsive">
                                                                    <table class="table m-0 p-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th class="w-100" style="min-width:180px;">
                                                                                    ГРУППА
                                                                                </th>
                                                                                <th class="w-100" style="min-width:150px;">
                                                                                    IP-ADDRESS
                                                                                </th>
                                                                                <th class="w-100" style="min-width:165px;">
                                                                                    БЫЛ(А) В СЕТИ
                                                                                </th>
                                                                                <th class="w-100" style="min-width:175px;">
                                                                                    РЕАЛЬНЫЙ БАЛАНС
                                                                                </th>
                                                                                <th class="w-100" style="min-width:155px;">
                                                                                    ДОХОД ЗА МЕСЯЦ
                                                                                </th>
                                                                                <th class="w-100" style="min-width:135px;">
                                                                                    КОНВЕРСИЯ
                                                                                </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    @if(@$user->access == 0)
                                                                                    <span class="text-success">Пользователь</span>
                                                                                    @elseif(@$user->access == 1)
                                                                                    <span class="text-danger">Администратор</span>
                                                                                    @else
                                                                                    <span>Неизвестна</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if(@$user->ip_address)
                                                                                    {{ @$user->ip_address }}
                                                                                    @else
                                                                                    Неизвестно
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if(@$user->auth_at)
                                                                                    {{ @App\Http\Controllers\ToolsController::sumbolsAgos(Illuminate\Support\Carbon::createFromTimestamp(@$user->auth_at)) }}
                                                                                    @else
                                                                                    Неизвестно
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    {{ (!@$user->balance_real) ? 0 : @$user->balance_real }} {{ @$general->currency_symbol }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ number_format(@$spent_month, 2, '.', '') }} {{ $general->currency_symbol }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ @$spent_conversion }}% за месяц
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @foreach($servers as $server)
                                                @php
                                                $user_privilege = App\UsersPrivileges::where([
                                                ['user_id', '=', @$user->id],
                                                ['server_id', '=', @$server->id]
                                                ])->first();

                                                $buys_privilege = App\Privileges::where('id', '=', @$user_privilege->privilege_id)->first();
                                                @endphp
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr style="background-color:rgba(0, 0, 0, 0.075);">
                                                            <th class="w-100" colspan="2" style="text-transform:uppercase;">
                                                                СЕРВЕР {{ @$server->name }}
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="table-responsive">
                                                                    <table class="table m-0 p-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th class="w-100" style="min-width:220px;">
                                                                                    ПРИВИЛЕГИЯ
                                                                                </th>
                                                                                {{-- <th class="w-100" style="min-width:120px;">
                                                                                    БАЛАНС
                                                                                </th> --}}
                                                                                <!-- <th class="w-100" style="min-width:120px;">
                                                                                    ПРЕФИКС
                                                                                    </th> -->
                                                                                <th class="w-100" style="min-width:120px;">
                                                                                    СКИНЫ
                                                                                </th>
                                                                                <th class="w-100" style="min-width:120px;">
                                                                                    СКИНЫ HD
                                                                                </th>
                                                                                <th class="w-100" style="min-width:120px;">
                                                                                    ПЛАЩИ
                                                                                </th>
                                                                                <th class="w-100" style="min-width:120px;">
                                                                                    ПЛАЩИ HD
                                                                                </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    @if(!@$buys_privilege['name'])
                                                                                    ИГРОК - НЕОГРАНИЧЕННО
                                                                                    @else
                                                                                    {{ @$buys_privilege['name'] }} - ДО {{ date("d.m.Y H:i", @$user_privilege['privilege_term']) }}
                                                                                    @endif
                                                                                </td>
                                                                                <!-- <td>
                                                                                    PREF
                                                                                    </td> -->
                                                                                <td>
                                                                                    @if(@$buys_privilege['skin'] || !@$user_privilege['id'])
                                                                                    <span style="color: #0a8f3c;">
                                                                                    <i class="fa fa-check-circle"></i> Разрешены
                                                                                    </span>
                                                                                    @else
                                                                                    <span style="color: #8f2331;">
                                                                                    <i class="fa fa-times-circle"></i> Запрещены
                                                                                    </span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if(@$buys_privilege['skin_hd'])
                                                                                    <span style="color: #0a8f3c;">
                                                                                    <i class="fa fa-check-circle"></i> Разрешены
                                                                                    </span>
                                                                                    @else
                                                                                    <span style="color: #8f2331;">
                                                                                    <i class="fa fa-times-circle"></i> Запрещены
                                                                                    </span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if(@$buys_privilege['cloak'])
                                                                                    <span style="color: #0a8f3c;">
                                                                                    <i class="fa fa-check-circle"></i> Разрешены
                                                                                    </span>
                                                                                    @else
                                                                                    <span style="color: #8f2331;">
                                                                                    <i class="fa fa-times-circle"></i> Запрещены
                                                                                    </span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if(@$buys_privilege['cloak_hd'])
                                                                                    <span style="color: #0a8f3c;">
                                                                                    <i class="fa fa-check-circle"></i> Разрешены
                                                                                    </span>
                                                                                    @else
                                                                                    <span style="color: #8f2331;">
                                                                                    <i class="fa fa-times-circle"></i> Запрещены
                                                                                    </span>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="edit">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="form" method="POST" action="{{route('admin.usersList.user.update', $user->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <label>Группа</label>
                                                        <select name="access" id="access" class="form-control">
                                                        <option value="0" {{ ($user->access == 0) ? 'selected' : '' }}>Пользователь</option>
                                                        <option value="1" {{ ($user->access == 1) ? 'selected' : '' }}>Администратор</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Статус</label>
                                                        <select name="status" id="status" class="form-control">
                                                        <option value="1" {{ ($user->status == 1) ? 'selected' : '' }}>Активен</option>
                                                        <option value="0" {{ ($user->status == 0) ? 'selected' : '' }}>Заблокирован</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Почта</label>
                                                        <input type="email" name="email" class="form-control" value="{{$user->email}}" {{ (!@$user->email) ? 'placeholder=Неизвестно' : '' }}>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Баланс</label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text" name="balance_real" value="{{ (!@$user->balance_real) ? 0 : @$user->balance_real }}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">{{ @$general->currency_symbol }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Сменить скин пользователя</label>

                                                        <div class="input-group">
                                                            <input type="file" id="skin" name="skin" class="custom-input-file" />
                                                            <label for="skin">
                                                                <i class="fas fa-upload"></i>
                                                                <span>Выберите файл…</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Сменить плащ пользователя</label>
                                                        <div class="input-group">
                                                            <input type="file" id="cloak" name="cloak" class="custom-input-file" />
                                                            <label for="cloak">
                                                                <i class="fas fa-upload"></i>
                                                                <span>Выберите файл…</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>UUID идентификатор</label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text" name="uuid" value="{{ @$user->uuid }}" placeholder="{{ (!@$user->uuid) ? 'Неизвестно' : @$user->uuid }}" readonly="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Ключ пользователя</label>
                                                        <div class="input-group">
                                                            <input class="form-control" type="text" name="remember_token" value="{{ @$user->remember_token }}" placeholder="{{ (!@$user->remember_token) ? 'Неизвестно' : @$user->remember_token }}" readonly="">
                                                            <div class="input-group-append">
     
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="modal-footer col-md-12 mt-2">
                                                        <button type="submit" class="btn btn-outline-primary btn-block">Сохранить данные</button>
                                                        <button type="button" class="btn btn-outline-danger btn-block" data-toggle="modal" data-target="#changepass" style="margin-bottom:7px;">
                                                        Изменить пароль
                                                        </button>  
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function refresh_api_key() {
      var rand = str_random(30);
      $('[name="api_key"]').val(rand);
    }
    function link_redirect_api() {
      var link = '{{ route('api') }}/?key={{ @$user->api_key }}&action=services';
      window.open(link, "_blank");
    }
    function refresh_remember_token() {
      var rand = str_random(60);
      $('[name="remember_token"]').val(rand);
    }
    function user_other_logout() {
      $.ajax({
        type: 'POST',
        url: '{{ route('admin.usersList.user.logout') }}',
        data: {
            _token: '{{ csrf_token() }}',
            id: '{{ @$user->id }}',
        },
        success: function (data) {
            notify(data.message, 8000, data.type);
        },
        error: function(data) {
            if(data.status === 422) {
                var errors = $.parseJSON(data.responseText);
                $.each(errors, function (key, value) {
                    if($.isPlainObject(value)) {
                        $.each(value, function (key, value) {
                            notify(value, 8000, "warning");
                        });
                    }
                });
            }
        }
    });
    }
</script>
<!--Change Pass Modal -->
<div id="changepass" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pull-left">Изменить пароль</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{route('admin.usersList.password.change', $user->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-6 control-label pl-0">Пароль</label>
                        <input id="password" type="password" data-hover-view="password" class="form-control" minlength="6" maxlength="32" min="6" max="32" name="password" required>
                        @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-6 control-label pl-0">Подтверждение пароля</label>
                        <input id="password-confirm" type="password" data-hover-view="password" class="form-control" minlength="6" maxlength="32" min="6" max="32" name="password_confirmation" required>
                        @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                        Изменить пароль
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection