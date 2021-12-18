@extends('admin.layouts.master')
@section('page_icon', 'fa fa-street-view')
@section('page_name', 'Список привилегий')
@section('body')
<div class="row">
	<div class="col-md-12">
        <div class="tile-main">
            <div class="tile tile-smot">
                <div class="tile-head">
                        <a style="text-transform:none;display:none;" class="btn btn-success privileges_list_adds_btn mb-4" href="#" data-toggle="modal" data-target="#privilegeAdds">
                            <i class="fa fa-plus-circle"></i> Добавить привилегию
                        </a>


                </div>
            </div>
    		<div class="tile">
                <div class="tile-body">
                    <div class="row">
            			<div class="col-md-12 p-0 mb-0">
            				<form action="#" role="form" method="post">
                                @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select class="form-control form-control-lg select-max-width" id="privileges_list_server_id" name="privileges_list_server_id">
                                                <option value="" selected disabled>Выберите сервер</option>
                                                @foreach($servers as $server)
                                                <option value="{{ @$server->id }}" data-server-id="{{ @$server->id }}" data-server-name="{{ @$server->name }}">{{ @$server->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="load_content" class="col-md-12 mt-3">
                                    
                                </div>
                            </form>
            	        </div>
            	        <div id="revenueStaticInfo" class="col-md-12 p-0" style="display:none;"></div>
                    </div>
                </div>
    		</div>
        </div>
	</div>
</div>
<div class="modal fade" id="privilegeAdds" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold text-left text-black">Добавление привилегии</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_privilege_adds" role="form" action="{{ route('admin.privilegesList.adds') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="justify-content-center text-center">
                                            <img id="privilege_img_preview" src="{{ asset('assets/minecraft/items') }}/default.png" width="85" height="85">
                                        </div>
                                        <div class="form-group">
                                            <label for="">
                                                <b style="font-size: 16px;">Картинка</b>
                                            </label>
                                            <div class="input-group">
                                                <input type="file" id="privilege_img_input_add" name="image" class="custom-input-file" value="" />
                                                <label for="privilege_img_input_add">
                                                    <i class="fas fa-upload"></i>
                                                    <span>Выберите файл…</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Название привилегии</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="name" class="form-control" placeholder="Название привилегии в плагине на права">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Отображаемое название</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="display_name" class="form-control" placeholder="Название привилегии на сайте">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Сервер предмета</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="hidden" id="server_id" name="server_id" value="0">
                                                    <input type="text" id="server_id_x" name="server_id_x" class="form-control" placeholder="Server" value="Server" readonly="">
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
                                                <label for="">
                                                    <b style="font-size: 16px;">Действует дней </b><i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" 
                                                    title="Впишите -1, если хотите, чтобы привилегия выдавалась навсегда"></i>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="term_days" class="form-control" placeholder="30">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
<i class="far fa-clock"></i>                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Стоимость привилегии</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="price" class="form-control" placeholder="10">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-ruble-sign"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Установка префикса</b>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control select-max-width" name="prefix">
                                                        <option value="" selected disabled>Выберите параметр</option>
                                                        <option value="1">Разрешена</option>
                                                        <option value="0">Запрещена</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Установка HD скинов</b>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control select-max-width" name="skin_hd">
                                                        <option value="" selected disabled>Выберите параметр</option>
                                                        <option value="1">Разрешена</option>
                                                        <option value="0">Запрещена</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Установка плащей</b>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control select-max-width" name="cloak">
                                                        <option value="" selected disabled>Выберите параметр</option>
                                                        <option value="1">Разрешена</option>
                                                        <option value="0">Запрещена</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Установка HD плащей</b>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control select-max-width" name="cloak_hd">
                                                        <option value="" selected disabled>Выберите параметр</option>
                                                        <option value="1">Разрешена</option>
                                                        <option value="0">Запрещена</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Установка скинов</b>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control select-max-width" name="skin">
                                                        <option value="" selected disabled>Выберите параметр</option>
                                                        <option value="1">Разрешена</option>
                                                        <option value="0">Запрещена</option>
                                                    </select>
                                                </div>
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
                    <button type="button" class="btn btn-primary btn-block privilege_adds">
                        Сохранить
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">

    function logoURL(input, divID) {
        if(input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + divID).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).on('change', '#privilege_img_input_add', function () {
        logoURL(this, 'privilege_img_preview');
    });

    var privileges_list_server_id = 0;
    var privileges_list_server_name = "Server";

    var hash_page = 1;
    window.location.hash = hash_page;
    
    $(window).on('hashchange', function() {
        if(window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if(page == Number.NaN || page <= 0) {
                return false;
            } else {
                hash_page = page;
            }
        }
    });

    function load_content() {
        privileges_list_server_id = $('#privileges_list_server_id').val();
        $("#load_content").slideUp(500);
        $(".privileges_list_adds_btn").fadeOut(500).attr('disabled', true);
        privileges_list_server_name = $("#privileges_list_server_id option:selected").data('server-name');
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.privilegesList.load') }}',
            data: {
                action: 'list',
                _token: csrf_token,
                privileges_list_server_id: privileges_list_server_id
            },
            success: function (data) {
                if(privileges_list_server_id) {
                    $('.privileges_list_adds_btn').fadeIn(500).attr('disabled', false);
                    $('#server_id').val(privileges_list_server_id);
                    $('#server_id_x').val(privileges_list_server_name);
                }
                $("#load_content").html(data).slideDown(500);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    $(document).on('change', '#privileges_list_server_id', function () {
        hash_page = 1;
        window.location.hash = hash_page;
        load_content();
    });

    $('.privilege_adds').on('click', function() {
        $(this).attr('disabled', true);
        var form = $('#form_privilege_adds')[0];
        var form_data = new FormData(form);
        
        $.ajax({
            type: "POST",
            url: "{{ route('admin.privilegesList.adds') }}",
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                notify(data.message, 8000, data.type);
                $('.privilege_adds').attr('disabled', false);
                if(data.type == "success") {
                    $('#privilegeAdds').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    load_content();
                }
            },
            error: function(data) {
                console.log(data);
                $('.privilege_adds').attr('disabled', false);
            }
        });
    });

</script>
@endsection