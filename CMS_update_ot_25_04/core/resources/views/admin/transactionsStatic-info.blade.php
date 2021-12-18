<div class="col-md-12 p-0">
    <div class="col-md-4 p-3 pt-0 float-left">
        <div class="card" data-toggle="tooltips" title="{{ date('d.m.Y') }}">
            <div class="card-header bg-secondary text-white">
                <span class="text-left float-left">
                    Транзакции за сутки
                </span>
                <span class="text-right float-right">
                    {{ @$transactions_count_today }} шт.
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-4 p-3 pt-0 float-left">
        <div class="card" data-toggle="tooltips" title="{{ date('m.Y') }}">
            <div class="card-header bg-secondary text-white">
                <span class="text-left float-left">
                    Транзакции за месяц
                </span>
                <span class="text-right float-right">
                    {{ @$transactions_count_month }} шт.
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-4 p-3 pt-0 float-left">
        <div class="card" data-toggle="tooltips" title="{{ date('Y') }}">
            <div class="card-header bg-secondary text-white">
                <span class="text-left float-left">
                    Транзакции за год
                </span>
                <span class="text-right float-right">
                    {{ @$transactions_count_years }} шт.
                </span>
            </div>
        </div>
    </div>
    <div class="clear-both"></div>
	<div class="table-responsive pl-3 pr-3 pt-0">
		<table class="table w-100">
	        <tr>
	            <th scope="col">ID</th>
                <th scope="col">Логин</th>
                <th scope="col">TRX</th>
                <th scope="col" style="min-width:110px;">Сумма</th>
                <th scope="col" style="min-width:110px;">Остаток</th>
                <th scope="col" style="min-width:150px;">Дата</th>
                <th scope="col" style="min-width:160px;">Статус</th>
	        </tr>
	        @if(count($transactions_list) == 0)
	            @if(@$search)
	            <tr class="text-center">
	                <td colspan="7">Результатов для пользователя {{ @$search }} не найдено</td> 
	            </tr>
	            @else
	            <tr class="text-center">
	                <td colspan="7">В данный момент список транзакций пуст</td> 
	            </tr>
	            @endif
	        @else
	        @foreach($transactions_list as $transactions_each)
            <?php
            $date = App\Http\Controllers\ToolsController::sumbolsDate(@$transactions_each->created_at);
            if($transactions_each->type == 0) {
                $sumb = '+';
                $type = '
                    <span style="color: #0d638f;">
                        <i class="fa fa-plus-circle" style="cursor:help;" data-toggle="tooltips" data-placement="right" title="Системное зачисление"></i>
                        Зачисление средств
                    </span>
                ';
            } elseif($transactions_each->type == 1) {
                $sumb = '-';
                $type = '
                    <span style="color: #0a8f3c;">
                        <i class="fa fa-cube" style="cursor:help;" data-toggle="tooltips" data-placement="right" title="Новый заказ"></i>
                        Новый заказ
                    </span>
                ';
            } elseif($transactions_each->type == 2) {
                $sumb = '+';
                $type = '
                    <span style="color: #8f2331;">
                        <i class="fa fa-times-circle" style="cursor:help;" data-toggle="tooltips" data-placement="right" title="Отмена заказа"></i>
                        Отмена заказа
                    </span>
                ';
            } elseif($transactions_each->type == 3) {
                $sumb = '+';
                $type = '
                    <span style="color: #e67419;">
                        <i class="fa fa-user-circle" style="cursor:help;" data-toggle="tooltips" data-placement="right" title="Бонус от '.@$transactions_each->usergateway->username.'"></i>
                        Реферальные бонусы
                    </span>
                ';
            } elseif($transactions_each->type == 4) {
                $sumb = '-';
                $type = '
                    <span style="color: #e91419;">
                        <i class="fa fa-cog" style="cursor:help;" data-toggle="tooltips" data-placement="right" title="Системное списание"></i>
                        Списание средств
                    </span>
                ';
            } elseif($transactions_each->type == 5) {
                $sumb = '-';
                $type = '
                    <span style="color: #0d5f3c;">
                        <i class="fa fa-cube" style="cursor:help;" data-toggle="tooltips" data-placement="right" title="Оплата быстрого заказа"></i>
                        Оплата заказа
                    </span>
                ';
            }
            ?>
            <tr>
                <td data-label="SL">#{{ $transactions_each->id }}</td>
                <td data-label="SL">
                    <a href="{{ route('admin.usersList.user', $transactions_each->user->id) }}">{{ $transactions_each->user->username }}</a>
                </td>
                <td data-label="#Trx">{{ $transactions_each->trx or 'N/A' }}</td>
                <td data-label="Amount">{{ @$sumb }}{{ number_format($transactions_each->amount, 2, '.', '') }} {{ $general->currency_symbol }}</td>
                <td data-label="Amount">{{ number_format($transactions_each->user_balance, 2, '.', '') }} {{ $general->currency_symbol }}</td>
                <td data-label="Time">
                    {{ @$date }}
                </td>
                <td data-label="Amount">
                    @php
                    echo @$type;
                    @endphp
                </td>
            </tr>
            @endforeach
	        @endif
	    </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $transactions_list->links() }}
    </div>
</div>