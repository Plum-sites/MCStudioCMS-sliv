@extends('admin.layouts.master')
@section('page_icon', 'fa fa-street-view')
@section('page_name', 'Список промокодов')
@section('body')
<div class="row">
	<div class="col-md-12">
        <div class="tile-main">
            <div class="tile tile-smot">
                <div class="tile-head">
                        <a style="text-transform:none;" class="btn btn-success kits_list_adds_btn mb-4" href="#" data-toggle="modal" data-target="#promoAdds">
                            <i class="fa fa-plus-circle"></i> Добавить промокод
                        </a>
                </div>
            </div>
    		<div class="tile">
                <div class="tile-body">
                    <div class="row">
            			<div class="col-md-12 p-0 mb-0">
                            <div class="table-responsive">
                                <table class="table table-lg table-expand w-100">
                                    <thead>
                                        <tr>
                                            <th style="min-width:60px;">ID</th>
                                            <th style="min-width:150px;">Код</th>
                                            <th style="min-width:150px;">% скидки</th>
                                            <th style="min-width:150px;">Категория</th>
                                            <th style="min-width:150px;">Статус</th>
                                            <th style="min-width:150px;">Кол-во применений</th>
                                            <th style="min-width:170px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!@$promos)
                                            <tr class="table-row text-center">
                                                <td colspan="7">В данный момент на проекте нет промокодов</td>
                                            </tr>
                                        @else
                                            @foreach($promos as $promo)
                                                <tr class="wow pulse" data-wow-delay="0.3s">
                                                    <td>
                                                        <span>
                                                            {{ @$promo->id }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            {{ @$promo->code }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            {{ @$promo->value }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            @if(@$promo->type == 1)
                                                            Привилегии 
                                                            @elseif (@$promo->type == 2)
                                                            Магазин блоков
                                                            @elseif (@$promo->type == 3)
                                                            Кит наборы
                                                            @elseif (@$promo->type == 0)
                                                            Любая
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            @if(@$promo->active == 1)
                                                            Активен 
                                                            @else 
                                                            Не активен
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            @if(@$promo->sales)
                                                            {{ @$promo->sales }}
                                                            @else 
                                                            0
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <form id="form_item_dels{{ @$promo->id }}" role="form" action="{{ route('admin.promosList.dels') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ @$promo->id }}">
                                                            <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 15px;"
                                                                data-toggle="modal"
                                                                data-target="#item{{ @$promo->id }}"
                                                                data-id="{{ @$promo->id }}"
                                                                data-item-code="{{ @$promo->code }}"
                                                                data-item-desc="{{ @$promo->desc }}"
                                                                data-item-value="{{ @$promo->value }}"
                                                                data-item-type="{{ @$promo->type }}"
                                                                data-item-sales="{{ @$promo->sales }}"
                                                                data-item-active="{{ @$promo->active }}"
                                                            >
                                                                Изменить
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-danger item_dels" style="font-size: 15px;" data-id="{{ @$promo->id }}">
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
            	        </div>
            	        <div id="revenueStaticInfo" class="col-md-12 p-0" style="display:none;"></div>
                    </div>
                </div>
    		</div>
        </div>
	</div>
</div>
{{-- Модалка для добавления промокода --}}
<div class="modal fade" id="promoAdds" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold text-left text-black">Добавление промо</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_promo_adds" role="form" action="{{ route('admin.promosList.adds') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Код</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="code" class="form-control" placeholder="SKIDKA10">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Размер скидки в %</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="value" class="form-control" placeholder="10">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="desc">
                                                    <b style="font-size: 16px;">Описание</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="desc" class="form-control" placeholder="Скидка 10%">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Категория</b>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control select-max-width" id="type" name="type">
                                                        <option value="" selected disabled>Выберите категорию промокода</option>
                                                        <option value="1">Привилегии</option>
                                                        <option value="2">Магазин блоков</option>
                                                        <option value="3">Кит наборы</option>
                                                        <option value="0">Любая</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Статус</b>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control select-max-width" id="active" name="active">
                                                        <option value="" selected disabled>Выберите статус промокода</option>
                                                        <option value="1">Активен</option>
                                                        <option value="0">Не активен</option>
                                                    </select>     
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
                    <button type="button" class="btn btn-primary btn-block promo_adds">
                        Сохранить
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- /Модалка для добавления промокода --}}
{{-- Модалки на изменение промо --}}
@foreach($promos as $promo)
<div class="modal fade" id="item{{ @$promo->id }}" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold text-left text-black">Промокод <b>{{ @$promo->code }}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_item_{{ @$promo->id }}" role="form" action="{{ route('admin.promosList.save') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ @$promo->id }}">
                <div class="modal-body">
                    <div class="portlet light bordered">
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Код</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="code" class="form-control" placeholder="SKIDKA10" value="{{ @$promo->code }}">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Размер скидки в %</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="value" class="form-control" placeholder="10" value="{{ @$promo->value }}">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="desc">
                                                    <b style="font-size: 16px;">Описание</b>
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="desc" class="form-control" placeholder="Скидка 10%" value="{{ @$promo->desc }}">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Категория</b>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control select-max-width" id="type" name="type">
                                                        <option value="" disabled>Выберите категорию промокода</option>
                                                        <option @if(@$promo->type == 1) selected @endif value="1">Привилегии</option>
                                                        <option @if(@$promo->type == 2) selected @endif value="2">Магазин блоков</option>
                                                        <option @if(@$promo->type == 3) selected @endif value="3">Кит наборы</option>
                                                        <option @if(@$promo->type == 0) selected @endif value="0">Любая</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="">
                                                    <b style="font-size: 16px;">Статус</b>
                                                </label>
                                                <div class="input-group">
                                                    <select class="form-control select-max-width" id="active" name="active">
                                                        <option value="" disabled>Выберите статус промокода</option>
                                                        <option @if(@$promo->active == 1) selected @endif value="1">Активен</option>
                                                        <option @if(@$promo->active == 0) selected @endif value="0">Не активен</option>
                                                    </select>                                                
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
                    <button type="button" class="btn btn-primary btn-block item_save" data-id="{{ @$promo->id }}">
                        Сохранить
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
{{-- /Модалки на изменение промо --}}

<script type="text/javascript">

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

    $('.promo_adds').on('click', function() {
        $(this).attr('disabled', true);
        var form = $('#form_promo_adds')[0];
        var form_data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "{{ route('admin.promosList.adds') }}",
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                notify(data.message, 8000, data.type);
                $('.promo_adds').attr('disabled', false);
                if(data.type == "success") {
                    $('#promoAdds').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    setTimeout(pageReload, 2000);
                }
            },
            error: function(data) {
                console.log(data);
                $('.promo_adds').attr('disabled', false);
            }
        });
    });

    $('.item_save').on('click', function() {
        var id = $(this).data('id');
        $(this).attr('disabled', true);
        var form = $('#form_item_' + id)[0];
        var form_data = new FormData(form);
        $.ajax({
            type: "POST",
            url: "{{ route('admin.promosList.save') }}",
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

                    setTimeout(pageReload, 2000);
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
            url: "{{ route('admin.promosList.dels') }}",
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                notify(data.message, 8000, data.type);
                $('.item_dels').attr('disabled', false);
                if(data.type == "success") {
                    setTimeout(pageReload, 2000);
                }
            },
            error: function(data) {
                console.log(data);
                $('.item_dels').attr('disabled', false);
            }
        });
    });

    function pageReload() {
        document.location.reload();
    }

</script>
@endsection