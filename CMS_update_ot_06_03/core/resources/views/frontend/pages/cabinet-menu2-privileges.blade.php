<!-- <hr> -->
@php
$user_privilege = App\UsersPrivileges::where([
  ['user_id', '=', @$user->id],
  ['server_id', '=', @$server->id]
])->first();
$buys_privilege = App\Privileges::where('id', '=', @$user_privilege->privilege_id)->first();
$days_operation = @$user_privilege->privilege_term - time();
$days_remains = floor($days_operation / (60 * 60 * 24));
@endphp
<div class="alert alert-group alert-primary alert-dismissible fade show alert-icon mt-4" role="alert">
  <div class="alert-group-prepend">
        <span class="alert-group-icon text-">
            <i class="fa fa-info-circle"></i>
        </span>
    </div>
    <div class="alert-content">
        <strong style="font-weight:700;">
          <!-- <span>
            [{{ @$server->name }}]
          </span> -->
          Текущая привилегия: 
          <span class="privilege_current">
            @if(!@$buys_privilege['name'])
            Игрок - действует неограниченно
            @elseif(@$user_privilege['privilege_term'] == -1 )
            {{ @$buys_privilege['display_name'] }} - действует неограниченно
            @else
            {{ @$buys_privilege['display_name'] }} - ещё {{ (@$days_remains <= 0) ? '0' : @$days_remains }} дн. (действует до {{ date("d.m.Y H:i", @$user_privilege['privilege_term']) }})
            @endif
          </span>
          
        </strong>
    </div>
</div>
<!-- <hr> -->
<div class="mt-4 text-center"><small>Возможности привилегий можно посмотреть</small>
  <a href="/donate" class="small font-weight-bold" target="_blank">здесь</a></div>
@if(count(@$privileges) > 0)
<div class="row bg-privileges">
  
	@foreach(@$privileges as $key => $privilege)
	    <div class="col-lg-4 col-md">
	        <div class="card card-pricing text-center px-3 mb-0 mt-3">
            @if(@$privilege->id == @$user_privilege->privilege_id)
            <span class="badge badge-primary" style="position:absolute;right:3px;top:3px;">Куплена</span>
            <!-- <span class="badge badge-primary" style="position:absolute;right:3px;top:3px;">Ещё {{ @$days_remains }} дн.</span> -->
            @endif
	            <div class="card-header py-2 border-0 delimiter-bottom">
                  <div style="padding:15px;background-image:radial-gradient(circle,rgb(255 153 0 / 21%) 0,#e2e8f000 70%);">
                      <img src="{{ asset('assets/minecraft/privileges') }}/{{ (!@$privilege->image) ? 'default.png?u=2' : @$privilege->image }}" style="width:100%;height:auto;">
                  </div>
	                <div class="h5 text-center mb-0">{{ @$privilege->display_name }}</div>
	            </div>
              <span class="h7 text-muted mt-2">{{ @$privilege->price }} {{ @$general->currency_symbol }} / @if(@$privilege->term_days != -1) {{ @$privilege->term_days }} дней @else  Навсегда @endif</span>
              <div class="row mt-2">
                <div class="col-md-12">
                  <button type="button" onclick="modal_privilege(this);" class="btn btn-sm btn-primary mb-3 w-100"
                    data-privilege-id="{{ @$privilege->id }}"
                    data-privilege-name="{{ @$privilege->name }}"
                    data-privilege-description="{{ @$privilege->description }}"
                    data-privilege-server-id="{{ @$privilege->servers->id }}"
                    data-privilege-server-name="{{ @$privilege->servers->name }}"
                    data-privilege-term-days="{{ @$privilege->term_days }}"
                    data-privilege-skin="{{ @$privilege->skin }}"
                    data-privilege-skin-hd="{{ @$privilege->skin_hd }}"
                    data-privilege-cloak="{{ @$privilege->cloak }}"
                    data-privilege-cloak-hd="{{ @$privilege->cloak_hd }}"
                    data-privilege-display-name="{{ @$privilege->display_name }}"
                    data-privilege-prefix="{{ @$privilege->prefix }}"
                    data-privilege-price="{{ @$privilege->price }}"
                    data-privilege-image="{{ asset('assets/minecraft/privileges') }}/{{ (!@$privilege->image) ? 'default.png?u=2' : @$privilege->image }}"
                    data-privilege-status="{{ @$privilege->status }}"
                    data-privilege-buys-is="{{ (@$privilege->id == @$user_privilege->privilege_id) ? '1' : '0' }}"
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
    $(document).on('change', '#promo', function () {
        $.ajax({
            type: 'POST',
            url: '{{ route('promo.check') }}',
            data: {
                _token: csrf_token,
                type: 1,
                code: $('#promo').val(),
                id: $('#modal_privilege_buys').data('privilege-id')
            },
            success: function(data) {
                console.log(data);
                if(data.new_price) {
                    $('#promo_label').text(data.desc + '. ' + 'Цена с учетом промо - ' + data.new_price + ' ' + $('#modal_privilege_price_symbol').text());
                    $('#modal_privilege_buys').attr('data-promo-id', data.promo_id);
                    $('#modal_privilege_buys').text('Приобрести со скидкой');
                }
                else {
                    $('#promo_label').text(data.desc);
                    $('#modal_privilege_buys').text('Приобрести');
                    $('#modal_privilege_buys').attr('data-promo-id', '');
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

  function modal_privilege(elem) {
      var privilege_id = $(elem).data('privilege-id');
      var privilege_name = $(elem).data('privilege-name');
      var privilege_display_name = $(elem).data('privilege-display-name');
      var privilege_description = $(elem).data('privilege-description');
      var privilege_server_id = $(elem).data('privilege-server-id');
      var privilege_server_name = $(elem).data('privilege-server-name');
      var privilege_term_days = $(elem).data('privilege-term-days');

      var privilege_skin_hd = $(elem).data('privilege-skin-hd');
      var privilege_skin = $(elem).data('privilege-skin');
      var privilege_cloak = $(elem).data('privilege-cloak');
      var privilege_cloak_hd = $(elem).data('privilege-cloak-hd');
      var privilege_prefix = $(elem).data('privilege-prefix');

      var privilege_count = $(elem).data('privilege-count');
      var privilege_price = $(elem).data('privilege-price');
      var privilege_image = $(elem).data('privilege-image');
      var privilege_status = $(elem).data('privilege-status');
      var privilege_buys_is = $(elem).data('privilege-buys-is');
      if(privilege_buys_is) {
        $('#modal_privilege_buys').html('Продлить');
        $('#privilege_buys_alert').fadeIn(10);
        $('#privilege_buys_alert_text').html('Вы уже обладаете данной привилегией');
      } else {
        $('#modal_privilege_buys').html('Приобрести');
        $('#privilege_buys_alert').fadeOut(10);
        $('#privilege_buys_alert_text').html('');
      }
      $('#modal_privilege_name').html('Привилегия ' + privilege_display_name);
      $('#modal_privilege_server_name').html(privilege_server_name);
      $('#modal_privilege_image').attr('src', privilege_image);
      $('#modal_privilege_price').html(privilege_price);
      $('#modal_privilege_term').html(privilege_term_days);

      var circle_check = '<i class="fa fa-check-circle text-success"></i>';
      var circle_times = '<i class="fa fa-times-circle text-warning"></i>';
      if(privilege_skin_hd) {
        $('#modal_privilege_skin_hd').html(circle_check);
      } else {
        $('#modal_privilege_skin_hd').html(circle_times);
      }
      if(privilege_skin) {
        $('#modal_privilege_skin').html(circle_check);
      } else {
        $('#modal_privilege_skin').html(circle_times);
      }
      if(privilege_cloak) {
        $('#modal_privilege_cloak').html(circle_check);
      } else {
        $('#modal_privilege_cloak').html(circle_times);
      }
      if(privilege_cloak_hd) {
        $('#modal_privilege_cloak_hd').html(circle_check);
      } else {
        $('#modal_privilege_cloak_hd').html(circle_times);
      }
      if(privilege_prefix) {
        $('#modal_privilege_prefix').html(circle_check);
      } else {
        $('#modal_privilege_prefix').html(circle_times);
      }

      $('#modal_privilege_buys').attr('data-privilege-id', privilege_id);
      privileges_buys_privilege_id = privilege_id; 
      $('#modal_privilege').modal('show');
  }

  function modal_privilege_calc(elem) {
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
      var count = $('#modal_kit_count').text();
      $('#kit_buys_alert').slideDown(500);
      var endprice = price * amount;
      var endcount = amount * count;
      $('#kit_buys_alert_endprice').html(endprice);
      $('#kit_buys_alert_endcount').html(endcount);
  }

  function modal_privilege_buys(elem) {
      if(privileges_buys_privilege_id) {
          $.ajax({
              type: 'POST',
              url: '{{ route('cabinet.privileges.buys') }}',
              data: {
                    action: 'buys',
                    _token: csrf_token,
                    privileges_buys_privilege_id: privileges_buys_privilege_id,
                    privileges_buys_promo_id: $('#modal_privilege_buys').data('promo-id')
              },
              success: function (data) {
                  notify(data.message, 8000, data.type);
                  if(data.type == "info") {
                      if(data.html.menu1) {
                        $('#menu1').html(data.html.menu1);
                      }
                      if(data.html.menu3) {
                        $('#menu3').html(data.html.menu3);
                      }
                      balance_get(0);
                      load_content_2();
                      $('#modal_privilege_buys').html('Продлить');
                      $('#privilege_buys_alert').fadeIn(10);
                      $('#privilege_buys_alert_text').html('Вы уже обладаете данной привилегией');
                  }
              },
              error: function(data) {
                  balance_get(0);
                  console.log(data);
              }
          });
      } else {
          notify("Произошла ошибка, обновите страницу", 8000, 'warning');
      }
  }

	$('.btn-privilege-buys').on('click', function() {
		var privilege_id = $(this).data('privilege-id');
    var promo_id = $(this).data('promo-id');
		console.log(privilege_id);
    console.log(promo_id);
		$.ajax({
            type: 'POST',
            url: '{{ route('cabinet.privileges.buys') }}',
            data: {
                action: 'list',
                _token: csrf_token,
                privileges_buys_privilege_id: privilege_id,
                privileges_buys_promo_id: promo_id
            },
            success: function(data) {
            	  // console.log(data);
                notify(data.message, 8000, data.type);
      		    	if(data.type == "info") {
      		    		balance_get(0);
      		    	}
      	    		if(data.html.privilege.name && data.html.privilege.term) {
                  var privilege_current = data.html.privilege.display-name + "- ещё " + data.html.privilege.days + " дн. (действует до " + data.html.privilege.term + ")";
                  $('.privilege_current').html(privilege_current);
                }
                if(data.html.menu1) {
                  $('#menu1').html(data.html.menu1);
                }
                // if(data.html.menu2) {
                //   $('#menu2').html(data.html.menu2);
                // }
                if(data.html.menu3) {
                  $('#menu3').html(data.html.menu3);
                }
                // if(data.html.menu4) {
                //   $('#menu4').html(data.html.menu4);
                // }
            },
            error: function(data) {
                console.log(data);
            }
        });
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
        <strong style="font-weight:700;">Привилегий на сервере {{ @$server->name }} в данный момент нет, зайдите позже =)</strong>
    </div>
</div>
@endif