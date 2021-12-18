<div class="table-responsive">
    <table class="table table-lg table-expand w-100">
        <thead>
            <tr>
                <th style="min-width:60px;">ID</th>
                <th style="max-width:20px;">
                	<i class="fa fa-image" style="font-size:16px;padding:5px;line-height:7px;"></i>
                </th>
                <th style="min-width:150px;">ПРЕДМЕТ</th>
                <th style="min-width:150px;">СЕРВЕР</th>
                <th style="min-width:150px;">КАТЕГОРИЯ</th>
                <th style="min-width:80px;">ЦЕНА ЗА КОЛ-ВО</th>
                <th style="min-width:170px;"></th>
            </tr>
        </thead>
        <tbody>
        	@if(count(@$items) <= 0)
                <tr class="table-row text-center">
                    <td colspan="7">В данный момент в выбранной категории товаров нет</td>
                </tr>
            @else
            	@foreach($items as $item)
                    <tr class="wow pulse" data-wow-delay="0.3s">
                        <td>
                            <span>
                                {{ @$item->id }}
                            </span>
                        </td>
                        <td>
                        	<img src="{{ asset('assets/minecraft/items') }}/{{ (!@$item->image) ? 'default.png' : @$item->image }}" width="20" height="20">
                        </td>
                        <td>
                            <span>
                                {{ @$item->name }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ @$item->servers->name }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ @$item->category->name }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ @$item->price }} руб. за {{ @$item->count }} шт.
                            </span>
                        </td>
                        <td>
                            <form id="form_item_dels{{ @$item->id }}" role="form" action="{{ route('admin.serversList.adds') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ @$item->id }}">
                                <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 15px;"
                                    data-toggle="modal"
                                    data-target="#item{{ @$item->id }}"
                                    data-id="{{ @$item->id }}"
                                    data-item-name="{{ @$item->name }}"
                                    data-item-description="{{ @$item->description }}"
                                    data-item-server-id="{{ @$item->servers->id }}"
                                    data-item-server-name="{{ @$item->servers->name }}"
                                    data-item-category-id="{{ @$item->category->id }}"
                                    data-item-category-name="{{ @$item->category->name }}"
                                    data-item-item-id="{{ @$item->item_id }}"
                                    data-item-count="{{ @$item->count }}"
                                    data-item-price="{{ @$item->price }}"
                                    data-item-image="{{ @$item->image }}"
                                    data-item-status="{{ @$item->status }}"
                                >
                                    Изменить
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger item_dels" style="font-size: 15px;" data-id="{{ @$item->id }}">
                                    <i class="fa fa-trash" style="margin:0 2px;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
            	@endforeach
            @endif
        </tbody>
    </table>
</div>
@foreach($items as $item)
<div class="modal fade" id="item{{ @$item->id }}" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold text-left text-black">Предмет <u>{{ @$item->name }}</u></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_item_{{ @$item->id }}" role="form" action="{{ route('admin.itemsList.adds') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ @$item->id }}">
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="justify-content-center text-center">
                                            <img id="item_img_preview_{{ @$item->id }}" src="{{ asset('assets/minecraft/items') }}/{{ (!@$item->image) ? 'default.png' : @$item->image }}" width="85" height="85">
                                        </div>
                                        <div class="form-group">
                                            <label for="">
                                                <b style="font-size: 16px;">Картинка</b>
                                            </label>
                                            <div class="input-group">
                                                <input type="file" id="item_img_input_save" name="image" class="custom-input-file" />
                                                <label for="item_img_input_save">
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
                                                    <input type="text" name="name" class="form-control" placeholder="Алмаз" value="{{ @$item->name }}">
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
                                                    <input type="text" name="count" class="form-control" placeholder="8" value="{{ @$item->count }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-sort-numeric-desc"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">
                                                    <b style="font-size: 16px;">Сервер предмета</b>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control select-max-width" id="server_id_{{ @$item->id }}" name="server_id">
                                                        <option value="" selected disabled>Выберите сервер предмета</option>
                                                        @foreach(@$servers as $server)
                                                        <option value="{{ @$server->id }}" data-server-id="{{ @$server->id }}" data-server-name="{{ @$server->name }}" {{ (@$item->server_id == @$server->id) ? 'selected' : '' }}>{{ @$server->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="">
                                                    <b style="font-size: 16px;">ID предмета</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="item_id" class="form-control" placeholder="ID:DATAID" value="{{ @$item->item_id }}">
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
                                                    <input type="text" name="price" class="form-control" placeholder="10" value="{{ @$item->price }}">
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
                                                    <!-- <input type="hidden" name="category_id" value="0">
                                                    <input type="text" name="category_id_x" class="form-control" placeholder="Category" value="Category" readonly="">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-cubes"></i>
                                                        </span>
                                                    </div> -->
                                                    <select class="form-control select-max-width" id="category_id_{{ @$item->id }}" name="category_id">
                                                        <option value="" selected disabled>Выберите категорию предмета</option>
                                                        @php
                                                        $categorys = App\Category::where('server_id', '=', @$item->server_id)->get();
                                                        @endphp
                                                        @foreach(@$categorys as $category)
                                                        <option value="{{ @$category->id }}" data-category-id="{{ @$category->id }}" data-category-name="{{ @$category->name }}" {{ (@$item->category_id == @$category->id) ? 'selected' : '' }}>{{ @$category->name }}</option>
                                                        @endforeach
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
                    <button type="button" class="btn btn-primary btn-block item_save" data-id="{{ @$item->id }}">
                        Сохранить
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#server_id_{{ @$item->id }}').on('change', function() {
    var serv_id = $(this).val();
    var item_id = '{{ @$item->id }}';
    var category_id = '{{ @$item->category_id }}';
    $.ajax({
        type: 'POST',
        url: '{{ route('admin.itemsList.load') }}',
        data: {
            action: 'list',
            _token: csrf_token,
            items_list_server_id: serv_id
        },
        success: function (data) {
            // console.log(data);
            $('#category_id_' + item_id).html('');
            $('#category_id_' + item_id).val('');
            $('#category_id_' + item_id).html('<option value="" selected disabled>Выберите категорию товара</option>');
            $.each(data, function (index, value) {
                $('#category_id_' + item_id).append('<option value="' + value.id + '" data-category-id="' + value.id + '" data-category-name="' + value.name + '">' + value.name + '</option>');
            });
            $('#category_id_' + item_id).val('');
        },
        error: function(data) {
            $('#category_id_' + item_id).html('');
            $('#category_id_' + item_id).html('<option value="" selected disabled>Выберите категорию товара</option>');
        }
    });
});
</script>
@endforeach
<script type="text/javascript">

    $(document).on('change', '.item_img_input_save', function () {
        var item_id = $(this).data('item-id');
        logoURL(this, 'item_img_preview_' + item_id);
    });

    $('.item_save').on('click', function() {
        var id = $(this).data('id');
        $(this).attr('disabled', true);
        var form = $('#form_item_' + id)[0];
        var form_data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "{{ route('admin.itemsList.save') }}",
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                notify(data.message, 8000, data.type);
                $('.item_save').attr('disabled', false);
                if(data.type == "success") {
                    $('#item' + id).modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    load_content();
                }
            },
            error: function(data) {
                $('.item_save').attr('disabled', false);
            }
        });
    });

    $('.item_dels').on('click', function() {
        var id = $(this).data('id');
        $(this).attr('disabled', true);
        var form = $('#form_item_dels' + id)[0];
        var form_data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "{{ route('admin.itemsList.dels') }}",
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                notify(data.message, 8000, data.type);
                $('.item_dels').attr('disabled', false);
                if(data.type == "success") {
                    load_content();
                }
            },
            error: function(data) {
                console.log(data);
                $('.item_dels').attr('disabled', false);
            }
        });
    });

</script>