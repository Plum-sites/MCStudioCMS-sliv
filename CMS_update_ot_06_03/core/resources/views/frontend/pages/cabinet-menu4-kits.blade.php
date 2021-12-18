@if(count(@$kits) > 0)
<div class="row bg-kits">
  	@foreach(@$kits as $key => $kit)
      <div class="col-lg-4 col-md">
          <div class="card card-pricing text-center px-3 mb-0 mt-3">
              <div class="card-header py-2 border-0 delimiter-bottom">
                  <div style="padding:15px;background-image:radial-gradient(circle,rgb(0 138 255 / 21%) 0,#e2e8f000 70%);">
                      <img src="{{ asset('assets/minecraft/kits') }}/{{ (!@$kit->image) ? 'default.png?u=2' : @$kit->image }}" style="width:85px;height:100%;">
                  </div>
                  <span class="h5" style="text-transform:uppercase;">{{ @$kit->name }}</span>
              </div>
              <span class="h7 text-muted mt-2">{{ @$kit->description }}</span>
              <div class="row mt-2">
                <div class="col-md-12">
                  <button type="button" onclick="modal_kit(this);" class="btn btn-sm btn-primary mb-3 w-100"
                    data-kit-id="{{ @$kit->id }}"
                    data-kit-name="{{ @$kit->name }}"
                    data-kit-description="{{ @$kit->description }}"
                    data-kit-server-id="{{ @$kit->servers->id }}"
                    data-kit-server-name="{{ @$kit->servers->name }}"
                    data-kit-count="{{ @$kit->count }}"
                    data-kit-price="{{ @$kit->price }}"
                    data-kit-image="{{ asset('assets/minecraft/kits') }}/{{ (!@$kit->image) ? 'default.png?u=2' : @$kit->image }}"
                    data-kit-status="{{ @$kit->status }}"
                  >
                    Подробнее
                  </button>
                </div>
              </div>
          </div>
      </div>
    @endforeach
</div>
<script type="text/javascript">
    // Проверка промокода в привилегиях
    $(document).on('change', '#kit_promo', function () {
        $.ajax({
            type: 'POST',
            url: '{{ route('promo.check') }}',
            data: {
                _token: csrf_token,
                type: 3,
                code: $('#kit_promo').val(),
                id: $('#modal_kit_buys').data('kit-id')
            },
            success: function(data) {
                console.log(data);
                if(data.new_price) {
                    $('#kit_promo_label').text(data.desc + '. ' + 'Цена за штуку с учетом промо - ' + data.new_price + ' ' + $('#modal_privilege_price_symbol').text());
                    $('#modal_kit_buys').attr('data-promo-id', data.promo_id);
                    $('#modal_kit_buys').attr('data-promo-value', data.promo_value);
                    $('#modal_kit_buys').text('Приобрести со скидкой');
                    modal_kit_calc($('#kit_buys_amount'));
                }
                else {
                    $('#kit_promo_label').text(data.desc);
                    $('#modal_kit_buys').text('Приобрести');
                    $('#modal_kit_buys').attr('data-promo-id', '');
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

  function modal_kit(elem) {
      var kit_id = $(elem).data('kit-id');
      var kit_name = $(elem).data('kit-name');
      var kit_description = $(elem).data('kit-description');
      var kit_server_id = $(elem).data('kit-server-id');
      var kit_server_name = $(elem).data('kit-server-name');
      var kit_count = $(elem).data('kit-count');
      var kit_price = $(elem).data('kit-price');
      var kit_image = $(elem).data('kit-image');
      var kit_status = $(elem).data('kit-status');
      $('#modal_kit_name').html('Набор ' + kit_name);
      $('#modal_kit_server_name').html(kit_server_name);
      $('#modal_kit_image').attr('src', kit_image);
      $('#modal_kit_price').html(kit_price);
      $('#modal_kit_count').html(kit_count);
      $('#kit_buys_amount').val('1');
      $('#modal_kit_buys').attr('data-kit-id', kit_id);
      modal_kit_calc($('#kit_buys_amount'));
      $('#modal_kit').modal('show');
  }

  function modal_kit_calc(elem) {
      if($('#kit_buys_amount').val() == '') {
          $('#kit_buys_amount').val('');
      } else if($('#kit_buys_amount').val() < 1) {
          $('#kit_buys_amount').val('');
      } else if($('#kit_buys_amount').val() > 10000) {
          $('#kit_buys_amount').val('10000');
      }
      var amount = $(elem).val();
      if(amount <= 0 && amount != '') {
          $(elem).val('1');
          amount = 1;
      }
      var price = $('#modal_kit_price').text();
      var promo = parseInt($('#modal_kit_buys').attr('data-promo-value'), 10);
      console.log(promo);
      var count = $('#modal_kit_count').text();
      $('#kit_buys_alert').slideDown(500);
      var endprice = price * amount;
      if(promo) {
        endprice = endprice - (endprice / 100 * promo);
      }
      var endcount = amount * count;
      $('#kit_buys_alert_endprice').html(endprice);
      $('#kit_buys_alert_endcount').html(endcount);
  }

  function modal_kit_buys(elem) {
      var kits_buys_kit_id = $(elem).data('kit-id'); 
      var kits_buys_kit_server_id = $('#kits_list_server_id').val();
      var kits_buys_kit_amount = $('#kit_buys_amount').val();
      var kits_buys_promo_id = $('#modal_kit_buys').data('promo-id');
      if(kits_buys_kit_server_id) {
          if(kits_buys_kit_amount >= 1) {
              $.ajax({
                  type: 'POST',
                  url: '{{ route('cabinet.kits.buys') }}',
                  data: {
                      action: 'buys',
                      _token: csrf_token,
                      kits_buys_kit_id: kits_buys_kit_id,
                      kits_buys_kit_server_id: kits_buys_kit_server_id,
                      kits_buys_kit_amount: kits_buys_kit_amount,
                      kits_buys_promo_id: kits_buys_promo_id
                  },
                  success: function (data) {
                      notify(data.message, 8000, data.type);
                      if(data.type == "info") {
                          balance_get(0);
                      }
                  },
                  error: function(data) {
                      balance_get(0);
                      console.log(data);
                  }
              });
          } else {
              notify("Кол-во не может быть меньше 1 шт", 8000, 'warning');
          }
      } else {
          notify("Выберите сервер для покупки набора", 8000, 'warning');
      }
  }

	// $('.btn-kit-buys').on('click', function() {
	// 	var kit_id = $(this).data('kit-id');
	// 	$.ajax({
 //            type: 'POST',
 //            url: '{{ route('cabinet.kits.buys') }}',
 //            data: {
 //                action: 'list',
 //                _token: csrf_token,
 //                kits_buys_privilege_id: kit_id
 //            },
 //            success: function(data) {
 //            	  // console.log(data);
 //                notify(data.message, 8000, data.type);
 //      		    	if(data.type == "info") {
 //      		    		balance_get(0);
 //      		    	}
 //      	    		if(data.html.menu1) {
 //      	    			$('#menu1').html(data.html.menu1);
 //      	    		}
 //            },
 //            error: function(data) {
 //                console.log(data);
 //            }
 //        });
	// });

  $(document).on('change', '#kit_buys_amount', function () {
      modal_kit_calc(this);
  });

  $(document).on('keyup', '#kit_buys_amount', function () {
      modal_kit_calc(this);
  });
</script>
@else
 <div class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert">
	<div class="alert-group-prepend">
        <span class="alert-group-icon text-">
            <i class="fa fa-info-circle"></i>
        </span>
    </div>
    <div class="alert-content">
        <strong style="font-weight:700;">Наборов на сервере {{ @$server->name }} в данный момент нет, зайдите позже =)</strong>
    </div>
</div>
@endif