@extends('admin.layouts.master')
@section('page_icon', 'fa fa-list-ol')
@section('page_name', 'Пользователь ')
@section('body')
<!-- <script>$('.app-title div h1').html('<i class="fa fa-users"></i> Пользователь {{ @$user->username }}');</script> -->
<div class="row">
    @include('admin.layouts.flash')
    <div class="col-md-12">
        <div class="tile-main">
            <div class="tile tile-smot">
                <div class="tile-head">
                    <div class="name">
                        <i class="@yield('page_icon')"></i>
                        @yield('page_name') {{ @$user->username }}
                    </div>
                    <div class="icon">
                        <a href="{{ route('admin.usersList.user', @$user->id) }}" class="btn btn-sm btn-outline-danger service_adds_btn">
                            <i class="fa fa-backward"></i> Назад
                        </a>
                        <a style="text-transform:none;" class="btn btn-outline-success btn-sm" href="#" data-toggle="modal" data-target="#addNotify">
                            <i class="fa fa-plus-circle"></i> Отправить уведомление
                        </a>
                    </div>
                    <div class="cler"></div>
                </div>
            </div>
            <div class="tile">
                <div class="col-md-12 p-0">
                    <form action="#" role="form" method="post">
                        @csrf
                        <div class="col-md-4 float-left">
                            <div class="form-group" id="statuses_div">
                                <select class="form-control select-max-width font-size-for-mobile-17" id="status" name="status">
                                    <option value="" selected>Все уведомления</option>
                                    <option value="" disabled>Список статусов</option>
                                    <option value="0">Доставленные</option>
                                    <option value="1">Не доставленные</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 float-left">
                            <div class="col-md-12 p-0" id="searcher_div">
                                <div class="col-md-10 float-left p-0 mb-3">
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Поиск по теме">
                                </div>
                                <div class="col-md-2 float-right p-0">
                                    <div class="form-group pr-0">
                                        <button type="button" id="searcher_btn" class="btn btn-secondary btn-block font-size-for-mobile-17 w-100">
                                            Поиск
                                        </button>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
                </div>
                <div id="usersNotifyInfo" class="col-md-12 p-0" style="display:none;"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNotify" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold text-left text-black">Отправить уведомление</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="portlet light bordered">
                    <div class="portlet-body form">
                        <form id="form_notify_add" role="form" action="#" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ @$user->id }}">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for=""><b style="font-size: 16px;">Тип уведомления</b></label>
                                    <select name="notify_type" class="form-control form-control-lg">
                                        <option value="" selected disabled>Выберите тип</option>
                                        <option value="1">Обычное уведомление</option>
                                        <option value="2">Модальное уведомление</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for=""><b style="font-size: 16px;">Название темы</b></label>
                                    <input type="text" name="subject" class="form-control form-control-lg">
                                </div>
                                <div id="notify_toastr" class="row" style="display:none;">
                                    <div class="form-group col-md-6">
                                        <label for=""><b style="font-size: 16px;">Системный тип уведомления</b></label>
                                        <select name="type" class="form-control form-control-lg">
                                            <option value="" selected disabled>Выберите системный тип</option>
                                            <option value="info">Info - инфо</option>
                                            <option value="error">Error - ошибка</option>
                                            <option value="danger">Danger - опасность</option>
                                            <option value="success">Success - успешность</option>
                                            <option value="warning">Warning - предупреждение</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for=""><b style="font-size: 16px;">Время показа уведомления (МС)</b></label>
                                        <input type="number" name="timeout" class="form-control form-control-lg" placeholder="60000" value="60000">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for=""><b style="font-size: 16px;">Сообщение</b></label>
                                    <textarea class="form-control" name="message" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <button id="notify_add" type="button" class="btn btn-primary btn-block btn-lg">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                    Сохранить
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<script>
    var status = '';
    var search = '';

    var _GET = window.location.search.replace('?','').split('&').reduce(function(p, e) {
        var a = e.split('=');
        p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
        return p;
    }, {});

    function usersNotifyInfo() {
        status = $('#status').val();
        search = $('#search').val();
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.usersList.notify.info') }}',
            data: {
                _token: '{{ csrf_token() }}',
                page: (!_GET['page']) ? 0 : _GET['page'],
                id: '{{ @$user->id }}',
                action: 'info',
                status: status,
                search: search
            },
            success: function(data) {
                $("#usersNotifyInfo").html(data).slideDown();
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
    usersNotifyInfo();
    setInterval(function() {
        usersNotifyInfo();
    }, 60000);

    $(document).on('change', '#status', function () {
        usersNotifyInfo();
    });
    $(document).on('keyup', '#search', function () {
        if($(this).val() == '') {
            usersNotifyInfo();
        }
    });
    $(document).on('click', '#searcher_btn', function () {
        usersNotifyInfo();
    });

    $('select[name="notify_type"]').on('change', function () {
        var notify_type = this.value;
        // console.log(notify_type);
        if(notify_type == 1) {
            $('#notify_toastr').slideDown();
        } else {
            $('#notify_toastr').slideUp();
        }
    });
    $('#notify_add').on('click', function() {
        var formdata = new FormData($("#form_notify_add")[0]);
        formdata.append('page', (!_GET['page']) ? 0 : _GET['page']);
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.usersList.notify.send') }}',
            data: formdata,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data) {
                if(data.type == 'success') {
                    usersNotifyInfo();
                    $("#addNotify").modal('hide');
                    $('[name="subject"]').val('');
                    $('[name="message"]').val('');
                }
                notify(data.message, 8000, data.type);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
</script>

@endsection