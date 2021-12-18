<div class="table-responsive">
    <table class="table table-lg table-expand w-100">
        <thead>
            <tr>
                <th style="max-width:20px;">
                	<i class="fa fa-image" style="font-size:16px;padding:5px;line-height:7px;"></i>
                </th>
                <th style="min-width:150px;">ПРЕДМЕТ</th>
                <th style="min-width:80px;">ЦЕНА ЗА КОЛ-ВО</th>
                <th style="min-width:100px;"></th>
            </tr>
        </thead>
        <tbody>
        	@if(count(@$items) <= 0)
                <tr class="table-row text-center">
                    <td colspan="4">В данный момент в выбранной категории товаров нет</td>
                </tr>
            @else
            	@foreach($items as $item)
                    <tr class="wow pulse" data-wow-delay="0.3s">
                        <td>
                        	<img src="{{ asset('assets/minecraft/items') }}/{{ (!@$item->image) ? 'default.png?u=1' : @$item->image }}" width="25" height="25">
                        </td>
                        <td>
                            <span>
                                {{ @$item->name }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ @$item->price }} {{ @$general->currency_symbol }} за {{ @$item->count }} шт.
                            </span>
                        </td>
                        <td>
                            <button type="button" onclick="modal_item(this);" class="btn btn-sm btn-primary w-100"
                        		data-item-id="{{ @$item->id }}"
                        		data-item-name="{{ @$item->name }}"
                        		data-item-description="{{ @$item->description }}"
                        		data-item-server-id="{{ @$item->servers->id }}"
                        		data-item-server-name="{{ @$item->servers->name }}"
                        		data-item-category-id="{{ @$item->category->id }}"
                        		data-item-category-name="{{ @$item->category->name }}"
                        		data-item-item-id="{{ @$item->item_id }}"
                        		data-item-count="{{ @$item->count }}"
                        		data-item-price="{{ @$item->price }}"
                        		data-item-image="{{ asset('assets/minecraft/items') }}/{{ (!@$item->image) ? 'default.png' : @$item->image }}"
                        		data-item-status="{{ @$item->status }}"
                            >
					            Подробнее
					        </button>
                        </td>
                    </tr>
            	@endforeach
            @endif
        </tbody>
    </table>
</div>
<script type="text/javascript">

        // Проверка промокода в привилегиях
        $(document).on('change', '#item_promo', function () {
        $.ajax({
            type: 'POST',
            url: '{{ route('promo.check') }}',
            data: {
                _token: csrf_token,
                type: 2,
                code: $('#item_promo').val(),
                id: $('#modal_item_buys').data('item-id')
            },
            success: function(data) {
                console.log(data);
                if(data.new_price) {
                    $('#item_promo_label').text(data.desc + '. ' + 'Цена за штуку с учетом промо - ' + data.new_price + ' ' + $('#modal_privilege_price_symbol').text());
                    $('#modal_item_buys').attr('data-promo-id', data.promo_id);
                    $('#modal_item_buys').attr('data-promo-value', data.promo_value);
                    $('#modal_item_buys').text('Приобрести со скидкой');
                    modal_item_calc($('#item_buys_amount'));
                }
                else {
                    $('#item_promo_label').text(data.desc);
                    $('#modal_item_buys').text('Приобрести');
                    $('#modal_item_buys').attr('data-promo-id', '');
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    function modal_item(elem) {
        console.log('Вызвалось модальное окно');
        var item_id = $(elem).data('item-id');
        var item_name = $(elem).data('item-name');
        var item_description = $(elem).data('item-description');
        var item_server_id = $(elem).data('item-server-id');
        var item_server_name = $(elem).data('item-server-name');
        var item_category_id = $(elem).data('item-category-id');
        var item_category_name = $(elem).data('item-category-name');
        var item_item_id = $(elem).data('item-item-id');
        var item_count = $(elem).data('item-count');
        var item_price = $(elem).data('item-price');
        var item_image = $(elem).data('item-image');
        var item_status = $(elem).data('item-status');
        $('#modal_item_name').html(item_name);
        $('#modal_item_item_id').html(item_item_id);
        $('#modal_item_server_name').html(item_server_name);
        $('#modal_item_image').attr('src', item_image);
        $('#modal_item_price').html(item_price);
        $('#modal_item_count').html(item_count);
        $('#item_buys_amount').val('1');
        $('#modal_item_buys').attr('data-item-id', item_id);
        console.log($('#modal_item_buys').attr('data-item-id'));
        modal_item_calc($('#item_buys_amount'));
        $('#modal_item').modal('show');
        console.log($('#modal_item_buys').attr('data-item-id'));
    }

    function modal_item_buys(elem) {
        var storets_item_id = $(elem).attr('data-item-id'); 
        console.log(elem);
        console.log(storets_item_id);
        var storets_list_server_id = $('#storets_list_server_id').val();
        var storets_item_amount = $('#item_buys_amount').val();
        var storets_item_promo_id = $('#modal_item_buys').attr('data-promo-id');
        console.log(storets_item_promo_id);
        if(storets_list_server_id) {
            if(storets_item_amount >= 1) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('storets.buys') }}',
                    data: {
                        action: 'buys',
                        _token: csrf_token,
                        storets_item_id: storets_item_id,
                        storets_item_amount: storets_item_amount,
                        storets_item_promo_id: storets_item_promo_id
                    },
                    success: function (data) {
                        notify(data.message, 8000, data.type);
                        if(data.type == "info") {
                            balance_get(0);
                        }
                    },
                    error: function(data) {
                        $("#balance_game").html('0');
                    }
                });
            } else {
                notify("Кол-во не может быть меньше 1 шт", 8000, 'warning');
            }
        } else {
            notify("Выберите сервер для покупки предмета", 8000, 'warning');
        }
    }

    function modal_item_calc(elem) {
        if($('#item_buys_amount').val() == '') {
              $('#item_buys_amount').val('');
          } else if($('#item_buys_amount').val() < 1) {
              $('#item_buys_amount').val('');
          } else if($('#item_buys_amount').val() > 10000) {
              $('#item_buys_amount').val('10000');
          }
        var amount = $(elem).val();
        if(amount <= 0 && amount != '') {
            $(elem).val('1');
            amount = 1;
        }
        var promo = parseInt($('#modal_item_buys').attr('data-promo-value'), 10);
        console.log(promo);
        var price = $('#modal_item_price').text();
        var count = $('#modal_item_count').text();
        $('#item_buys_alert').slideDown(500);
        var endprice = price * amount;
        if(promo) {
            endprice = endprice - (endprice / 100 * promo);
        }
        var endcount = amount * count;
        $('#item_buys_alert_endprice').html(endprice);
        $('#item_buys_alert_endcount').html(endcount);
    }

    $(document).on('change', '#item_buys_amount', function () {
        modal_item_calc(this);
    });

    $(document).on('keyup', '#item_buys_amount', function () {
        modal_item_calc(this);
    });

</script>