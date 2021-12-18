<div class="col-md-12 p-0">
    <div class="row">   
    <div class="col-lg-4 col-sm-6 px-2">
        <div class="card" data-toggle="tooltips" title="{{ date('d.m.Y') }}">
            <div class="card-body text-center">
                <div class="mb-3">
                    <div class="icon icon-shape icon-md bg-primary shadow-primary text-white">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <!-- Title -->
                <h5 class="h3 font-weight-bolder mb-1">{{ @$users_count_today }} чел.</h5>
                <!-- Subtitle -->
                <span class="d-block text-sm text-muted font-weight-bold">
                    Пользователей за день
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 px-2">
        <div class="card" data-toggle="tooltips" title="{{ date('m.Y') }}">
            <div class="card-body text-center">
                <div class="mb-3">
                    <div class="icon icon-shape icon-md bg-danger shadow-primary text-white">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <!-- Title -->
                <h5 class="h3 font-weight-bolder mb-1">{{ @$users_count_month }} чел.</h5>
                <!-- Subtitle -->
                <span class="d-block text-sm text-muted font-weight-bold">
                    Пользователей за месяц
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 px-2">
        <div class="card" data-toggle="tooltips" title="{{ date('Y') }}">
            <div class="card-body text-center">
                <div class="mb-3">
                    <div class="icon icon-shape icon-md bg-warning shadow-primary text-white">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <!-- Title -->
                <h5 class="h3 font-weight-bolder mb-1">{{ @$users_count_years }} чел.</h5>
                <!-- Subtitle -->
                <span class="d-block text-sm text-muted font-weight-bold">
                    Пользователей за год
                </span>
            </div>
        </div>
    </div>
</div>
	<div class="table-responsive pl-3 pr-3 pt-0">
		<table class="table w-100">
	        <tr>
	            <th scope="col">ID</th>
                <th scope="col">Логин</th>
                <th scope="col" style="min-width:110px;">Почта</th>
                <th scope="col" style="min-width:150px;">Дата</th>
                <th scope="col" style="min-width:130px;">Статус</th>
                <th scope="col"></th>
	        </tr>
	        @if(count($users_list) == 0)
	            @if(@$search)
	            <tr class="text-center">
	                <td colspan="6">Результатов для пользователя {{ @$search }} не найдено</td> 
	            </tr>
	            @else
	            <tr class="text-center">
	                <td colspan="6">В данный момент список пользователей пуст</td> 
	            </tr>
	            @endif
	        @else
	        @foreach($users_list as $users_each)
            <tr>
                <td>#{{ $users_each->id }}</td>
                <td>{{ $users_each->username }}</td>
                <td>{{ $users_each->email }}</td>
                <td>{{ @App\Http\Controllers\ToolsController::sumbolsDate(@$users_each->created_at) }}</td>
                <td>
                    @if($users_each->status == 0)
                    <span style="color: #8f2331;">Заблокирован</span>
                    @else
                    <span style="color: #0a8f3c;">Активен</span>
                    @endif
                </td>
                <td>
                	<a href="{{ route('admin.usersList.user', @$users_each->id) }}" class="btn btn-sm btn-info">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
	        @endif
	    </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $users_list->links() }}
    </div>
</div>