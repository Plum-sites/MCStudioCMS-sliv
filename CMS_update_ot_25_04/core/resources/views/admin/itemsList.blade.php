@extends('admin.layouts.master')
@section('page_icon', 'fa fa-shopping-cart')
@section('page_name', 'Список предметов')
@section('body')
<div class="row">
	<div class="col-md-12">
        <div class="tile-main">
            <div class="tile tile-smot">
                <div class="tile-head">
                        <a style="text-transform:none;display:none;" class="btn btn-success items_list_adds_btn mb-4" href="#" data-toggle="modal" data-target="#itemAdds">
                            <i class="fa fa-plus-circle"></i> Добавить предмет
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
                                        <div class="col-md-6">
                                            <select class="form-control form-control-lg select-max-width" id="items_list_server_id" name="items_list_server_id">
                                                <option value="" selected disabled>Выберите сервер</option>
                                                @foreach($servers as $server)
                                                <option value="{{ @$server->id }}" data-server-id="{{ @$server->id }}" data-server-name="{{ @$server->name }}">{{ @$server->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div id="storets_catogory" class="col-md-6">
                                            <select class="form-control form-control-lg select-max-width" id="items_list_category_id" name="items_list_category_id" disabled>
                                                <option value="" selected disabled>Выберите категорию товара</option>
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
<div class="modal fade" id="itemAdds" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold text-left text-black">Добавление предмета</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_item_adds" role="form" action="{{ route('admin.itemsList.adds') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="justify-content-center text-center">
                                            <img id="item_img_preview" src="{{ asset('assets/minecraft/items') }}/default.png" width="85" height="85">
                                        </div>
                                        <div class="form-group">
                                            <label for="">
                                                <b style="font-size: 16px;">Картинка</b>
                                            </label>
                                            <div class="input-group">
                                                <input type="file" id="item_img_input" name="image" class="custom-input-file" />
                                                <label for="item_img_input">
                                                    <i class="fas fa-upload"></i>
                                                    <span>Выберите файл…</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="">
                                                    <b style="font-size: 16px;">Название предмета</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="name" class="form-control" placeholder="Алмаз">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">
                                                    <b style="font-size: 16px;">Кол-во предмета</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="count" class="form-control" placeholder="8">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-sort-numeric-up-alt"></i>                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
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
                                            <div class="form-group col-md-4">
                                                <label for="">
                                                    <b style="font-size: 16px;">ID предмета</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="item_id" class="form-control" placeholder="ID:DATAID">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-cube"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">
                                                    <b style="font-size: 16px;">Стоимость предмета</b>
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
                                            <div class="form-group col-md-4">
                                                <label for="">
                                                    <b style="font-size: 16px;">Категория предмета</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="hidden" id="category_id" name="category_id" value="0">
                                                    <input type="text" id="category_id_x" name="category_id_x" class="form-control" placeholder="Category" value="Category" readonly="">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-cubes"></i>
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
                    <button type="button" class="btn btn-primary btn-block item_adds">
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
    $(document).on('change', '#item_img_input', function () {
        logoURL(this, 'item_img_preview');
    });

    var items_list_server_id = 0;
    var items_list_server_name = "Server";
    var items_list_category_id = 0;
    var items_list_category_name = "Category";

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
        items_list_server_id = $('#items_list_server_id').val();
        items_list_category_id = $('#items_list_category_id').val();
        // $("#load_content").slideUp(500);
        $(".items_list_adds_btn").fadeOut(500).attr('disabled', true);
        items_list_server_name = $("#items_list_server_id option:selected").data('server-name');
        items_list_category_name = $("#items_list_category_id option:selected").data('category-name');
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.itemsList.load') }}',
            data: {
                action: 'list',
                _token: csrf_token,
                items_list_server_id: items_list_server_id,
                items_list_category_id: items_list_category_id
            },
            success: function (data) {
                if(items_list_server_id && items_list_category_id) {
                    $('.items_list_adds_btn').fadeIn(500).attr('disabled', false);
                    $('#server_id').val(items_list_server_id);
                    $('#server_id_x').val(items_list_server_name);
                    $('#category_id').val(items_list_category_id);
                    $('#category_id_x').val(items_list_category_name);
                }
                if(!items_list_category_id && items_list_server_id) {
                    $('#items_list_category_id').attr('disabled', false);
                    $('#items_list_category_id').html('');
                    $('#items_list_category_id').html('<option value="" selected disabled>Выберите категорию товара</option>');
                    $.each(data, function (index, value) {
                        $('#items_list_category_id').append('<option value="' + value.id + '" data-category-id="' + value.id + '" data-category-name="' + value.name + '">' + value.name + '</option>');
                    });
                } else {
                    $("#load_content").html(data);
                }
            },
            error: function(data) {
                $('#items_list_category_id').html('');
                $('#items_list_category_id').html('<option value="" selected disabled>Выберите категорию товара</option>');
            }
        });
    }

    $(document).on('change', '#items_list_server_id', function () {
        hash_page = 1;
        window.location.hash = hash_page;
        $("#load_content").html('');
        $('#items_list_category_id').val('');
        load_content();
    });
    $(document).on('change', '#items_list_category_id', function () {
        hash_page = 1;
        window.location.hash = hash_page;
        load_content();
    });

    $('.item_adds').on('click', function() {
        $(this).attr('disabled', true);
        var form = $('#form_item_adds')[0];
        var form_data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "{{ route('admin.itemsList.adds') }}",
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                notify(data.message, 8000, data.type);
                $('.item_adds').attr('disabled', false);
                if(data.type == "success") {
                    $('#itemAdds').modal('hide');
                    load_content();
                }
            },
            error: function(data) {
                console.log(data);
                $('.item_adds').attr('disabled', false);
            }
        });
    });

</script>
@endsection