<div class="table-responsive">
    <table class="table table-lg table-expand w-100">
        <thead>
            <tr>
                <th style="min-width:60px;">ID</th>
                <th style="min-width:150px;">ПРИВИЛЕГИЯ</th>
                <th style="min-width:150px;">СЕРВЕР</th>
                <th style="min-width:80px;">ЦЕНА</th>
                <th style="min-width:100px;">ДЕЙСТВУЕТ</th>
                <th style="min-width:170px;"></th>
            </tr>
        </thead>
        <tbody>
        	@if(count(@$privileges) <= 0)
                <tr class="table-row text-center">
                    <td colspan="7">В данный момент на выбранном сервере привилегий нет</td>
                </tr>
            @else
            	@foreach($privileges as $privilege)
                    <tr class="wow pulse" data-wow-delay="0.3s">
                        <td>
                            <span>
                                {{ @$privilege->id }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ @$privilege->display_name }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ @$privilege->servers->name }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ @$privilege->price }} {{ @$general->currency_symbol }}
                            </span>
                        </td>
                        <td>
                            <span>
                                @if(@$privilege->term_days != -1 ) {{ @$privilege->term_days }} дн. @else Бесконечно @endif
                            </span>
                        </td>
                        <td>
                            <form id="form_privilege_dels{{ @$privilege->id }}" role="form" action="{{ route('admin.privilegesList.adds') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ @$privilege->id }}">
                                <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 15px;"
                                    data-toggle="modal"
                                    data-target="#privilege{{ @$privilege->id }}"
                                    data-id="{{ @$privilege->id }}"
                                    data-privilege-name="{{ @$privilege->name }}"
                                    data-privilege-display-name="{{ @$privilege->display_name }}"
                                    data-privilege-description="{{ @$privilege->description }}"
                                    data-privilege-server-id="{{ @$privilege->servers->id }}"
                                    data-privilege-server-name="{{ @$privilege->servers->name }}"
                                    data-privilege-price="{{ @$privilege->price }}"
                                    data-privilege-image="{{ (!@$privilege->image) ? 'default.png?u=2' : @$privilege->image }}"
                                    data-privilege-status="{{ @$privilege->status }}"
                                >
                                    Изменить
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger privilege_dels" style="font-size: 15px;" data-id="{{ @$privilege->id }}">
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
@foreach($privileges as $key => $privilege)
<div class="modal fade" id="privilege{{ @$privilege->id }}" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold text-left text-black">Привилегия <u>{{ @$privilege->display_name }}</u></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_privilege_{{ @$privilege->id }}" role="form" action="{{ route('admin.privilegesList.adds') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ @$privilege->id }}">
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="justify-content-center text-center">
                                            <img id="privilege_img_preview_{{ @$privilege->id }}" src="{{ asset('assets/minecraft/privileges') }}/{{ (!@$privilege->image) ? 'default.png?u=2' : @$privilege->image }}" style="width:100%;height:auto;">
                                        </div>
                                        <div class="form-group">
                                            <label for="">
                                                <b style="font-size: 16px;">Картинка</b>
                                            </label>
                                            <div class="input-group">
                                                <input type="file" id="privilege_img_input" data-id="{{ @$privilege->id }}" name="image" class="custom-input-file" />
                                                <label for="privilege_img_input">
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
                                                    <input type="text" name="name" class="form-control" placeholder="Название привилегии в плагине на права" value="{{ @$privilege->name }}">
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
                                                    <input type="text" name="display_name" class="form-control" placeholder="Название привилегии на сайте" value="{{ @$privilege->display_name }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Сервер привилегии</b>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control select-max-width" name="server_id">
                                                        <option value="" selected disabled>Выберите сервер</option>
                                                        @foreach($servers as $server)
                                                        <option value="{{ @$server->id }}" data-server-id="{{ @$server->id }}" data-server-name="{{ @$server->name }}" {{ (@$privilege->server_id == @$server->id) ? 'selected' : '' }}>{{ @$server->name }}</option>
                                                        @endforeach
                                                    </select>
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
                                                    <input type="text" name="term_days" class="form-control" placeholder="30" value="{{ @$privilege->term_days }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="far fa-clock"></i>    
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Стоимость привилегии</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="price" class="form-control" placeholder="10" value="{{ @$privilege->price }}">
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
                                                        <option value="1" {{ (@$privilege->prefix == 1) ? 'selected' : '' }}>Разрешена</option>
                                                        <option value="0" {{ (@$privilege->prefix == 0) ? 'selected' : '' }}>Запрещена</option>
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
                                                        <option value="1" {{ (@$privilege->skin_hd == 1) ? 'selected' : '' }}>Разрешена</option>
                                                        <option value="0" {{ (@$privilege->skin_hd == 0) ? 'selected' : '' }}>Запрещена</option>
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
                                                        <option value="1" {{ (@$privilege->cloak == 1) ? 'selected' : '' }}>Разрешена</option>
                                                        <option value="0" {{ (@$privilege->cloak == 0) ? 'selected' : '' }}>Запрещена</option>
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
                                                        <option value="1" {{ (@$privilege->cloak_hd == 1) ? 'selected' : '' }}>Разрешена</option>
                                                        <option value="0" {{ (@$privilege->cloak_hd == 0) ? 'selected' : '' }}>Запрещена</option>
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
                                                        <option value="1" {{ (@$privilege->skin == 1) ? 'selected' : '' }}>Разрешена</option>
                                                        <option value="0" {{ (@$privilege->skin == 0) ? 'selected' : '' }}>Запрещена</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="1" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Привилегия активна" data-off="Привилегия не активна" data-width="100%">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block privilege_save" data-id="{{ @$privilege->id }}">
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

    $(document).on('change', '#privilege_img_input', function () {
        var id = $(this).data('id');
        logoURL(this, 'privilege_img_preview_' + id);
    });

    $('.privilege_save').on('click', function() {
        var id = $(this).data('id');
        $(this).attr('disabled', true);
        var form = $('#form_privilege_' + id)[0];
        var form_data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "{{ route('admin.privilegesList.save') }}",
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                notify(data.message, 8000, data.type);
                $('.privilege_save').attr('disabled', false);
                if(data.type == "success") {
                    $('#privilege' + id).modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    load_content();
                }
            },
            error: function(data) {
                console.log(data);
                $('.privilege_save').attr('disabled', false);
            }
        });
    });

    $('.privilege_dels').on('click', function() {
        var id = $(this).data('id');
        $(this).attr('disabled', true);
        var form = $('#form_privilege_dels' + id)[0];
        var form_data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "{{ route('admin.privilegesList.dels') }}",
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                notify(data.message, 8000, data.type);
                $('.privilege_dels').attr('disabled', false);
                if(data.type == "success") {
                    load_content();
                }
            },
            error: function(data) {
                console.log(data);
                $('.privilege_dels').attr('disabled', false);
            }
        });
    });

</script>