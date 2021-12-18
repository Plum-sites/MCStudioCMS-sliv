<div class="table-responsive">
    <table class="table table-lg table-expand w-100">
        <thead>
            <tr>
                <th style="min-width:60px;">ID</th>
                <th style="max-width:20px;">
                	<i class="fa fa-image" style="font-size:16px;padding:5px;line-height:7px;"></i>
                </th>
                <th style="min-width:150px;">Название</th>
                <th style="min-width:150px;">Сервер</th>
                <th style="min-width:150px;">Стоимость</th>
                <th style="min-width:170px;"></th>
            </tr>
        </thead>
        <tbody>
        	@if(count(@$kits) <= 0)
                <tr class="table-row text-center">
                    <td colspan="7">В данный момент на сервере нет наборов</td>
                </tr>
            @else
            	@foreach($kits as $kit)
                    <tr class="wow pulse" data-wow-delay="0.3s">
                        <td>
                            <span>
                                {{ @$kit->id }}
                            </span>
                        </td>
                        <td>
                        	<img src="{{ asset('assets/minecraft/kits') }}/{{ (!@$kit->image) ? 'default.png' : @$kit->image }}" width="20" height="20">
                        </td>
                        <td>
                            <span>
                                {{ @$kit->name }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ @$kit->servers->name }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ @$kit->price }} руб. за {{ @$kit->count }} шт.
                            </span>
                        </td>
                        <td>
                            <form id="form_item_dels{{ @$kit->id }}" role="form" action="{{ route('admin.serversList.adds') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ @$kit->id }}">
                                <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 15px;"
                                    data-toggle="modal"
                                    data-target="#item{{ @$kit->id }}"
                                    data-id="{{ @$kit->id }}"
                                    data-item-name="{{ @$kit->name }}"
                                    data-item-server-id="{{ @$kit->servers->id }}"
                                    data-item-server-name="{{ @$kit->servers->name }}"
                                    data-item-count="{{ @$kit->count }}"
                                    data-item-price="{{ @$kit->price }}"
                                    data-item-image="{{ @$kit->image }}"
                                    data-item-status="{{ @$kit->status }}"
                                >
                                    Изменить
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger item_dels" style="font-size: 15px;" data-id="{{ @$kit->id }}">
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
@foreach($kits as $kit)
<div class="modal fade" id="item{{ @$kit->id }}" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold text-left text-black">Набор <u>{{ @$kit->name }}</u></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_item_{{ @$kit->id }}" role="form" action="{{ route('admin.kitsList.adds') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ @$kit->id }}">
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="justify-content-center text-center">
                                            <img id="item_img_preview_{{ @$kit->id }}" src="{{ asset('assets/minecraft/kits') }}/{{ (!@$kit->image) ? 'default.png' : @$kit->image }}" width="85" height="85">
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
                                                    <b style="font-size: 16px;">Название набора</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="name" class="form-control" placeholder="Алмаз" value="{{ @$kit->name }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">
                                                    <b style="font-size: 16px;">Кол-во набора</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="count" class="form-control" placeholder="8" value="{{ @$kit->count }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-sort-numeric-desc"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">
                                                    <b style="font-size: 16px;">Сервер набора</b>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control select-max-width" id="server_id_{{ @$kit->id }}" name="server_id">
                                                        <option value="" selected disabled>Выберите сервер предмета</option>
                                                        @foreach(@$servers as $server)
                                                        <option value="{{ @$server->id }}" data-server-id="{{ @$server->id }}" data-server-name="{{ @$server->name }}" {{ (@$kit->server_id == @$server->id) ? 'selected' : '' }}>{{ @$server->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Команда для выдачи</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="price" class="form-control" placeholder="kit vip %player%" value="{{ @$kit->server_cmd }}">
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
                                                    <input type="text" name="price" class="form-control" placeholder="10" value="{{ @$kit->price }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-ruble-sign"></i>
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
                    <button type="button" class="btn btn-primary btn-block item_save" data-id="{{ @$kit->id }}">
                        Сохранить
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#server_id_{{ @$kit->id }}').on('change', function() {
    var serv_id = $(this).val();
    var item_id = '{{ @$kit->id }}';
    $.ajax({
        type: 'POST',
        url: '{{ route('admin.kitsList.load') }}',
        data: {
            action: 'list',
            _token: csrf_token,
            items_list_server_id: serv_id
        },
        success: function (data) {

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
            url: "{{ route('admin.kitsList.save') }}",
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
                console.log(data);
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
            url: "{{ route('admin.kitsList.dels') }}",
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