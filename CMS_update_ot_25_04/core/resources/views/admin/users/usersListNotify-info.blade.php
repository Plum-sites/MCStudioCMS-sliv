<div class="col-md-12 p-0">
	<div class="table-responsive pl-3 pr-3 pt-0">
		<table class="table w-100">
	        <tr>
	            <th scope="col">ID</th>
                <th scope="col" style="min-width:180px;">Тема</th>
                <th scope="col" style="min-width:150px;">Дата</th>
                <th scope="col" style="min-width:130px;">Статус</th>
                <th scope="col"></th>
	        </tr>
	        @if(count($notify_list) == 0)
	            <tr class="text-center">
	                <td colspan="5">В данный момент список уведомлений пуст</td> 
	            </tr>
	        @else
	        @foreach($notify_list as $notify_each)
            <tr>
                <td>#{{ $notify_each->id }}</td>
                <td>{{ @$notify_each->subject }}</td>
                <td>{{ @App\Http\Controllers\ToolsController::sumbolsDate(@$notify_each->created_at) }}</td>
                <td>
                    @if($notify_each->status == 1)
                    <span style="color: #8f2331;">Не доставлен</span>
                    @else
                    <span style="color: #0a8f3c;">Доставлен</span>
                    @endif
                </td>
                <td>ф
                	<!-- <a href="{{ route('admin.usersList.user', @$notify_each->id) }}" class="btn btn-outline-info">
                        <i class="fa fa-eye"></i>
                    </a> -->
                </td>
            </tr>
            @endforeach
	        @endif
	    </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $notify_list->links() }}
    </div>
</div>