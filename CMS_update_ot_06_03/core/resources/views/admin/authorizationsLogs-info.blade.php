<div class="col-md-12 p-0">
    <div class="col-md-4 p-3 pt-0 float-left">
        <div class="card" data-toggle="tooltips" title="{{ date('d.m.Y') }}">
            <div class="card-header bg-secondary text-white">
                <span class="text-left float-left">
                    Авторизации за сутки
                </span>
                <span class="text-right float-right">
                    {{ @$authorizations_count_today }} шт.
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-4 p-3 pt-0 float-left">
        <div class="card" data-toggle="tooltips" title="{{ date('m.Y') }}">
            <div class="card-header bg-secondary text-white">
                <span class="text-left float-left">
                    Авторизации за месяц
                </span>
                <span class="text-right float-right">
                    {{ @$authorizations_count_month }} шт.
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-4 p-3 pt-0 float-left">
        <div class="card" data-toggle="tooltips" title="{{ date('Y') }}">
            <div class="card-header bg-secondary text-white">
                <span class="text-left float-left">
                    Авторизации за год
                </span>
                <span class="text-right float-right">
                    {{ @$authorizations_count_years }} шт.
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
                <th scope="col">IP-Адрес</th>
                <th scope="col" style="min-width:110px;">Браузер</th>
                <th scope="col" style="min-width:110px;">Платформа</th>
                <th scope="col" style="min-width:150px;">Дата</th>
                <th scope="col" style="min-width:120px;">Статус</th>
	        </tr>
	        @if(count($authorizations_list) == 0)
	            @if(@$search)
	            <tr class="text-center">
	                <td colspan="7">Результатов для пользователя {{ @$search }} не найдено</td> 
	            </tr>
	            @else
	            <tr class="text-center">
	                <td colspan="7">В данный момент список авторизаций пуст</td> 
	            </tr>
	            @endif
	        @else
	        @foreach($authorizations_list as $authorizations_each)
            <tr>
                <td data-label="SL">#{{ $authorizations_each->id }}</td>
                <td data-label="SL">
                    <a href="{{ route('admin.usersList.user', $authorizations_each->user->id) }}">{{ $authorizations_each->user->username }}</a>
                </td>
                <td data-label="#Trx">{{ $authorizations_each->user_ip }}</td>
                <td data-label="Amount">{{ $authorizations_each->user_browser }}</td>
                <td data-label="Amount">{{ $authorizations_each->user_os }}</td>
                <td data-label="Time">
                    {{ @App\Http\Controllers\ToolsController::sumbolsDate(@$authorizations_each->created_at) }}
                </td>
                <td data-label="Amount">
                    @if($authorizations_each->type == 0)
                    <span style="color: #8f2331;">Не успешно</span>
                    @else
                    <span style="color: #0a8f3c;">Успешно</span>
                    @endif
                </td>
            </tr>
            @endforeach
	        @endif
	    </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $authorizations_list->links() }}
    </div>
</div>