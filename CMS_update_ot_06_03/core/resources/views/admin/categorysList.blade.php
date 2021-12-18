@extends('admin.layouts.master')
@section('page_icon', 'fa fa-shopping-cart')
@section('page_name', 'Список категорий')
@section('body')
    <div class="row">
        @include('admin.layouts.flash')
        <div class="col-md-12">
            <div class="tile-main">
                <div class="tile tile-smot">
                    <div class="tile-head">
                            <a class="btn btn-success service_adds_btn mb-4" href="#" data-toggle="modal" data-target="#categoryAdds">
                                <i class="fa fa-plus-circle"></i> Добавить категорию
                            </a>
                    </div>
                </div>
                <div class="tile">
                    <div class="table-responsive">
                        <table class="table w-100">
                            <tr>
                                <th style="min-width:45px;">ID</th>
                                <th style="min-width:135px;">КАТЕГОРИЯ</th>
                                <th style="min-width:135px;">СЕРВЕР</th>
                                <th style="min-width:195px;">ПРЕДМЕТОВ</th>
                                <th style="min-width:170px;"></th>
                            </tr>
                            @foreach($categorys as $category)
                                <tr>
                                    <td style="font-size: 15px;">{{ @$category->id }}</td>
                                    <td style="font-size: 15px;">{{ @$category->name }}</td>
                                    <td style="font-size: 15px;">{{ (!@$category->servers->name) ? 'Неизвестен' : @$category->servers->name }}</td>
                                    <td style="font-size: 15px;">{{ App\Items::where([['server_id', '=', @$category->server_id],['category_id', '=', @$category->id]])->count('id') }} шт.</td>
                                    <td>
                                        <form id="form_category_dels{{ @$category->id }}" role="form" action="{{ route('admin.categorysList.adds') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ @$category->id }}">
                                            <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 15px;"
                                                data-toggle="modal"
                                                data-target="#category{{ @$category->id }}"
                                                data-id="{{ @$category->id }}"
                                            >
                                                Изменить
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger category_dels" style="font-size: 15px;" data-id="{{ @$category->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ @$categorys->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="categoryAdds" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold text-left text-black">Добавление категории</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_category_adds" role="form" action="{{ route('admin.categorysList.adds') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="portlet light bordered">
                            <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">
                                                <b style="font-size: 16px;">Название категории</b>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="name" class="form-control" placeholder="Броня">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-server"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">
                                                <b style="font-size: 16px;">Сервер категории</b>
                                            </label>
                                            <div class="input-group">
                                                <select class="form-control select-max-width" name="server_id">
                                                    <option value="" selected disabled>Выберите сервер</option>
                                                    @foreach($servers as $server)
                                                    <option value="{{ @$server->id }}" data-server-id="{{ @$server->id }}" data-server-name="{{ @$server->name }}">{{ @$server->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="status" value="1" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Категория активна" data-off="Категория не активна" data-width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-block category_adds">
                            Сохранить
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach($categorys as $category)
        <div class="modal fade" id="category{{ @$category->id }}" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold text-left text-black">Категория <u>{{ @$category->name }}</u></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form_category_{{ @$category->id }}" role="form" action="{{ route('admin.categorysList.adds') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ @$category->id }}">
                        <div class="modal-body">
                            <div class="portlet light bordered">
                                <div class="portlet-body form">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Название категории</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="name" class="form-control" value="{{ @$category->name }}" placeholder="Броня">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-server"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Сервер категории</b>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control select-max-width" name="server_id">
                                                        <option value="" selected disabled>Выберите сервер</option>
                                                        @foreach($servers as $server)
                                                        <option value="{{ @$server->id }}" data-server-id="{{ @$server->id }}" data-server-name="{{ @$server->name }}" {{ (@$category->server_id == @$server->id) ? 'selected' : '' }}>{{ @$server->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="status" value="1" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Категория активна" data-off="Категория не активна" data-width="100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-block category_save" data-id="{{ @$category->id }}">
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
        $('.category_save').on('click', function() {
            var id = $(this).data('id');
            $(this).attr('disabled', true);
            var form = $('#form_category_' + id)[0];
            var form_data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{ route('admin.categorysList.save') }}",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data) {
                    notify(data.message, 8000, data.type);
                    $('.category_save').attr('disabled', false);
                    if(data.type == "success") {
                        setTimeout(function() {
                            document.location.reload();
                        }, 2000);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('.category_save').attr('disabled', false);
                }
            });
        });
        $('.category_adds').on('click', function() {
            $(this).attr('disabled', true);
            var form = $('#form_category_adds')[0];
            var form_data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{ route('admin.categorysList.adds') }}",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data) {
                    notify(data.message, 8000, data.type);
                    $('.category_adds').attr('disabled', false);
                    if(data.type == "success") {
                        setTimeout(function() {
                            document.location.reload();
                        }, 2000);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('.category_adds').attr('disabled', false);
                }
            });
        });
        $('.category_dels').on('click', function() {
            var id = $(this).data('id');
            $(this).attr('disabled', true);
            var form = $('#form_category_dels' + id)[0];
            var form_data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{ route('admin.categorysList.dels') }}",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data) {
                    notify(data.message, 8000, data.type);
                    $('.category_dels').attr('disabled', false);
                    if(data.type == "success") {
                        setTimeout(function() {
                            document.location.reload();
                        }, 2000);
                    }
                },
                error: function(data) {
                    console.log(data);
                    $('.category_dels').attr('disabled', false);
                }
            });
        });
    </script>
@endsection