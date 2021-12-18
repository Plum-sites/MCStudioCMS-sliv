@extends('admin.layouts.master')
@section('page_icon', 'fa fa-users')
@section('page_name', 'Список пользователей')
@section('body')
<div class="row">
    @include('admin.layouts.flash')
    <div class="col-md-12">
        <div class="tile-main">
            <div class="tile tile-smot">
                {{-- <div class="tile-head">
                        <a style="text-transform:none;" class="btn btn-success service_adds_btn mb-4" href="#" data-toggle="modal" data-target="#addUser">
                            <i class="fa fa-user-plus"></i> Добавить пользователя
                        </a>
                </div> --}}
            </div>
            <div id="usersListInfo" class="col-md-12 p-0" style="display:none;"></div>
            <div class="tile">
                <div class="col-md-12">
                    <form action="#" role="form" method="post">
                        @csrf
                        <div class="col-md-4 float-left">
                            <div class="form-group" id="statuses_div">
                                <select class="form-control form-control-lg select-max-width font-size-for-mobile-17" id="status" name="status">
                                    <option value="" selected>Все пользователи</option>
                                    {{-- <option value="" disabled>Список статусов</option> --}}
                                    <option value="1">Активные</option>
                                    <option value="0">Заблокированные</option>
                                    {{-- <option value="" disabled>Список групп</option> --}}
                                    <option value="access_0">Пользователь</option>
                                    <option value="access_1">Администратор</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 float-left">
                            <div class="col-md-12 p-0" id="searcher_div">
                                <div class="col-md-10 float-left p-0 mb-3">
                                    <input type="text" class="form-control form-control-lg" id="search" name="search" placeholder="Поиск по логину">
                                </div>
                                <div class="col-md-2 float-right p-0">
                                    <div class="form-group pr-0">
                                        <button type="button" id="searcher_btn" class="btn ml-2 btn-success btn-block">
                                            Поиск
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addUser" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4><b>Добавить пользователя</b></h4>
            </div>
            <form id="form_adduser" method="post" action="#" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <div class="tile-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="">
                                                    <b style="font-size: 16px;">Логин</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="username" class="form-control" placeholder="Example">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">
                                                    <b style="font-size: 16px;">Почтовый ящик</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="email" name="email" class="form-control" placeholder="example@mail.ru">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">
                                                    <b style="font-size: 16px;">Баланс</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="number" name="balance" class="form-control" pattern="\d+(\.\d{2})?" min="0" placeholder="100.00">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Пароль</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="password" class="form-control" placeholder="75e6uihyl">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Повтор пароля</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="password_confirmation" class="form-control" placeholder="75e6uihyl">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Группа</b>
                                                </label>
                                                <div class="input-group">
                                                    <select name="access" class="form-control">
                                                        <option value="0" selected>Пользователь</option>
                                                        <option value="1">Администратор</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">API ключ</b>
                                                </label>
                                                <div class="input-group">
                                                    <input class="form-control" type="text" id="api_key" name="api_key" placeholder="4UZxKAsA5ufl42RKSdtrGejCmALKUW" readonly="">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" style="cursor:pointer;" onclick="refresh_api_key()" data-toggle="tooltips" data-placement="left" title="Сгенерировать">
                                                            <i class="fas fa-key"></i>
                                                        </span>
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
                <div class="modal-footer">
                    <button type="button" onclick="addsUser();" class="btn btn-primary btn-block">
                         Добавить
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function refresh_api_key() {
        var rand = str_random(30);
        $('[name="api_key"]').val(rand);
        // $('#api_key').val(rand);
    }
    $(document).ready(function() {
        refresh_api_key();
    });
    

    var status = '';
    var search = '';

    var _GET = window.location.search.replace('?','').split('&').reduce(function(p, e) {
        var a = e.split('=');
        p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
        return p;
    }, {});

    function usersListInfo() {
        status = $('#status').val();
        search = $('#search').val();
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.usersList.info') }}',
            data: {
                _token: '{{ csrf_token() }}',
                page: (!_GET['page']) ? 0 : _GET['page'],
                action: 'info',
                status: status,
                search: search
            },
            success: function(data) {
                $("#usersListInfo").html(data).slideDown();
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
    usersListInfo();
    setInterval(function() {
        usersListInfo();
    }, 60000);

    $(document).on('change', '#status', function () {
        usersListInfo();
    });
    $(document).on('keyup', '#search', function () {
        if($(this).val() == '') {
            usersListInfo();
        }
    });
    $(document).on('click', '#searcher_btn', function () {
        usersListInfo();
    });
    function addsUser() {
        var form = $('#form_adduser');
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.usersList.adds') }}',
            data: form.serialize(),
            success: function(data) {
                console.log(data);
                form[0].reset();
                $('#addUser').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                usersListInfo();
                notify("Пользователь " + data.username + " успешно зарегистрирован в системе", 8000, "success");
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

@endsection