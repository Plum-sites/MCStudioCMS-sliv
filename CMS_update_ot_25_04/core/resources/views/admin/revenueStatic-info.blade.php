<div class="col-md-12 p-0">
	<div class="col-md-4 p-3 pt-0 float-left">
        <div class="card" data-toggle="tooltips" title="{{ date('d.m.Y') }}">
            <div class="card-header bg-secondary text-white">
                <span class="text-left float-left">
                    Платежей за сутки
                </span>
                <span class="text-right float-right">
                    {{ @$bills_count_today }} шт.
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-4 p-3 pt-0 float-left">
        <div class="card" data-toggle="tooltips" title="{{ date('m.Y') }}">
            <div class="card-header bg-secondary text-white">
                <span class="text-left float-left">
                    Платежей за месяц
                </span>
                <span class="text-right float-right">
                    {{ @$bills_count_month }} шт.
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-4 p-3 pt-0 float-left">
        <div class="card" data-toggle="tooltips" title="{{ date('Y') }}">
            <div class="card-header bg-secondary text-white">
                <span class="text-left float-left">
                    Платежей за год
                </span>
                <span class="text-right float-right">
                    {{ @$bills_count_years }} шт.
                </span>
            </div>
        </div>
    </div>
    <div class="clear-both"></div>
	<div class="col-md-12 p-0">
		<div class="col-md-4 float-left pt-0">
			<div class="table-responsive">
				<table class="table w-100">
					<tr style="border:1.4px solid #aeaeae;">
						<td>
							<div style="text-align:center;">
								<div class="defaultcircle">
									<center>
										<b class="defaultsize" style="color:#b10047;">
											{{ @$bills_сonversion }}%
										</b>
										<br>
										<span>Конверсия</span>
									</center>
								</div>
							</div>
							<!-- <div style="margin: 0 42px;">
								<input type="text" id="conversion" style="margin-top:30px;" 
									data-fgColor="#debb05"
									data-max="100"
									data-thickness='.25'
									data-angleOffset='0'
									data-width='200'
									data-height='200'
									data-font='Arial'
									data-float='right'
									readonly
									value="{{ @$bills_сonversion }}"
								/>
							</div> -->
						</td>
					</tr>
					<tr style="border:1.4px solid #aeaeae;">
						<td>
							<div class="embed-responsive embed-responsive-16by9" style="padding:35px;margin-top:25px;margin-bottom:25px;">
	                            <canvas id="chart_bills_payments" class="embed-responsive-item" width="214" height="200"></canvas>
	                        </div>
							<!-- <div style="text-align:center;">
								<div class="defaultcircle">
									<center>
										<b class="defaultsize" style="color:#37a3b7;">
											{{ @$bills_total }}
										</b>
										<br>
										<span>Платежей</span>
									</center>
								</div>
							</div> -->
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="col-md-8 float-right p-0">
			<div class="table-responsive pl-3 pr-3 pt-0">
				<table class="table w-100">
			        <tr>
			            <th>#</th>
			            <th style="min-width:110px;">Логин</th>
			            <th style="min-width:110px;">Сумма</th>
			            <!-- <th style="min-width:130px;">Бонус</th> -->
			            <th style="min-width:100px;">Система</th>
			            <th style="min-width:150px;">Дата</th>
			            <th style="min-width:115px;">Статус</th>
			        </tr>
			        <?php
			        $all_summ = 0;
			        ?>
			        @if(count($bills_list) == 0)
			            @if(@$search)
			            <tr class="text-center">
			                <td colspan="7">Результатов для пользователя {{ @$search }} не найдено</td> 
			            </tr>
			            @else
			            <tr class="text-center">
			                <td colspan="7">В данный момент список платежей пуст</td> 
			            </tr>
			            @endif
			        @else
			        @foreach($bills_list as $payments)
			        <?php
			        	if(@$payments->status) {
			        		$payments->status = 'Оплачен';
			        	} else {
			        		$payments->status = 'Не оплачен';
			        	}
			        	$user = App\User::where('id', '=', @$payments->user_id)->first();
			        	// $all_summ = 0;
			        	$all_summ += $payments->money;
			        ?>
			        <tr>
			            <td>{{ $payments->id }}</td>
			            <td>
			            	<a href="{{ route('admin.usersList.user', $user->id) }}">{{ $user->username }}</a>
			            </td>
			            <td>{{ (!@$payments->money) ? '0' : @$payments->money }} {{ $general->currency_symbol }}</td>
			            <!-- <td>+{{ (!@$payments->bonus) ? '0' : @$payments->bonus }} {{ @$general->currency_symbol }}</td> -->
			            <td>{{ (!@$payments->system) ? 'Unknown' : @$payments->system }}</td>
			            <td>{{ App\Http\Controllers\ToolsController::sumbolsDate(@$payments->created_at) }}</td>
			            <td>{{ (!@$payments->status) ? 'Unknown' : @$payments->status }}</td>
			        </tr>
			        @endforeach
			        <!-- <tr>
			        	<td colspan="7">
			        		<b>
			        			<div class="float-left text-left">Сумма оплаченных платежей: {{ @$bills_payed_sum }} {{ $general->currency_symbol }}</div>
			        			<div class="float-right text-right">Сумма не оплаченных платежей: {{ @$bills_notpayed_sum }} {{ $general->currency_symbol }}</div>
			        			<div class="clear-both"></div>
			        		</b>
			        	</td>
			        </tr> -->
			        @endif
			    </table>
		    </div>
		</div>
		<div class="clear-both"></div>
	</div>
    <div class="d-flex justify-content-center">
        {{ $bills_list->links() }}
    </div>
</div>
<script>
	$(document).ready(function() {

		$('#conversion').knob({
		    'format': function (value) {
		       return value + '%';
		    }
		});

		var chart_bills_payments_data = [
			{
				value: '{{ @$bills_notpayed }}',
				color: "#F7464A",
				highlight : "#Fd5A5E",
				label : "Не оплаченные платежи"
			},
			{
				value: '{{ @$bills_payed }}',
				color : "#28a745",
				highlight : "#11a345",
				label : "Оплаченные платежи"
			}
		];
		var chart_bills_options = {
	        tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= value + ' шт.' %>",
	        multiTooltipTemplate: "<%= value + ' шт.' %>",
	    };
		var chart_bills_payments_ctxs = $("#chart_bills_payments").get(0).getContext("2d");
		var chart_bills_payments_main = new Chart(chart_bills_payments_ctxs).Pie(chart_bills_payments_data, chart_bills_options);
	});
</script>