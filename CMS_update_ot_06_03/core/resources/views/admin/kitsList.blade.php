@extends('admin.layouts.master')
@section('page_icon', 'fa fa-street-view')
@section('page_name', 'Список кит наборов')
@section('body')
<div class="row">
	<div class="col-md-12">
        <div class="tile-main">
            <div class="tile tile-smot">
                <div class="tile-head">
                        <a style="text-transform:none;display:none;" class="btn btn-success kits_list_adds_btn mb-4" href="#" data-toggle="modal" data-target="#kitAdds">
                            <i class="fa fa-plus-circle"></i> Добавить кит
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
                                            <select class="form-control form-control-lg select-max-width" id="kits_list_server_id" name="kits_list_server_id">
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
<div class="modal fade" id="kitAdds" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold text-left text-black">Добавление кит набора</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_kit_adds" role="form" action="{{ route('admin.kitsList.adds') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="justify-content-center text-center">
                                            <img id="kit_img_preview" src="{{ asset('assets/minecraft/kits') }}/default.png" width="85" height="85">
                                        </div>
                                        <div class="form-group">
                                            <label for="">
                                                <b style="font-size: 16px;">Картинка</b>
                                            </label>
                                            <div class="input-group">
                                                <input type="file" id="kit_img_input" name="image" class="custom-input-file" />
                                                <label for="kit_img_input">
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
                                                    <b style="font-size: 16px;">Название набора</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="name" class="form-control" placeholder="Vip">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Сервер набора</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="hidden" id="server_id" name="server_id" value="0">
                                                    <input type="text" id="server_id_x" name="server_id_x" class="form-control" placeholder="Server" value="Server" readonly="">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-server"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Команда выдачи набора</b> <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Должна соответствовать команде, через которую выдаются киты на сервере определенному пользователю с использованием переменной %player%."></i>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="server_cmd" class="form-control" placeholder="kit vip %player%">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-share"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Стоимость набора</b>
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
                                                    <b style="font-size: 16px;">Количество набора</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="count" class="form-control" placeholder="1">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-sort-numeric-up-alt"></i>
                                                        </span>
                                                    </div>
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
                    <button type="button" class="btn btn-primary btn-block kit_adds">
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
    $(document).on('change', '#kit_img_input', function () {
        logoURL(this, 'kit_img_preview');
    });

    var kits_list_server_id = 0;
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
        kits_list_server_id = $('#kits_list_server_id').val();
        $("#load_content").slideUp(500);
        $(".kits_list_adds_btn").fadeOut(500).attr('disabled', true);
        kits_list_server_name = $("#kits_list_server_id option:selected").data('server-name');
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.kitsList.load') }}',
            data: {
                action: 'list',
                _token: csrf_token,
                kits_list_server_id: kits_list_server_id
            },
            success: function (data) {
                if(kits_list_server_id) {
                    $('.kits_list_adds_btn').fadeIn(500).attr('disabled', false);
                    $('#server_id').val(kits_list_server_id);
                    $('#server_id_x').val(kits_list_server_name);
                }
                $("#load_content").html(data).slideDown(500);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    $(document).on('change', '#kits_list_server_id', function () {
        hash_page = 1;
        window.location.hash = hash_page;
        load_content();
    });

    $('.kit_adds').on('click', function() {
        $(this).attr('disabled', true);
        var form = $('#form_kit_adds')[0];
        var form_data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "{{ route('admin.kitsList.adds') }}",
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                notify(data.message, 8000, data.type);
                $('.kit_adds').attr('disabled', false);
                if(data.type == "success") {
                    $('#kitAdds').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    load_content();
                }
            },
            error: function(data) {
                console.log(data);
                $('.kit_adds').attr('disabled', false);
            }
        });
    });

</script>
@endsection