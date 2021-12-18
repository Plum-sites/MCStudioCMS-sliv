@extends('admin.layouts.master')
@section('page_icon', 'fa fa-list-ol')
@section('page_name', 'История транзакций')
@section('body')
<div class="row">
	@include('admin.layouts.flash')
	<div class="col-md-12">
        <div class="tile-main">
            <div class="tile tile-smot">
                <div class="tile-head">
                    <div class="name">
                        <i class="@yield('page_icon')"></i>
                        @yield('page_name')
                    </div>
                    <div class="icon">
                        
                    </div>
                    <div class="cler"></div>
                </div>
            </div>
    		<div class="tile">
    			<div class="col-md-12 p-0 mb-0">
    				<form action="#" role="form" method="post">
                        @csrf
                        <div class="col-md-4 float-left">
                            <div class="form-group" id="statuses_div">
                                <select class="form-control select-max-width font-size-for-mobile-17" id="status" name="status">
                                    <option value="" selected>Все транзакции</option>
                                    <option value="" disabled>Список статусов</option>
                                    <option value="0">Зачисление средств</option>
                                    <option value="1">Новые заказы</option>
                                    <option value="2">Отменённые заказы</option>
                                    <option value="3">Реферальные бонусы</option>
                                    <option value="4">Списание средств</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 float-left">
                            <div class="col-md-12 p-0" id="searcher_div">
                                <div class="col-md-10 float-left p-0 mb-3">
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Поиск по логину">
                                </div>
                                <div class="col-md-2 float-right p-0">
                                    <div class="form-group pr-0">
                                        <button type="button" id="searcher_btn" class="btn btn-secondary btn-block font-size-for-mobile-17 w-100">
                                            Поиск
                                        </button>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <div class="form-group pr-0" id="orderinf_div" style="display:none;"></div>
                        </div>
                        <div style="clear:both;"></div>
                    </form>
    	        </div>
    	        <div id="transactionsStaticInfo" class="col-md-12 p-0" style="display:none;"></div>
    		</div>
        </div>
	</div>
</div>
<script>
	var status = '';
	var search = '';

	var _GET = window.location.search.replace('?','').split('&').reduce(function(p, e) {
	    var a = e.split('=');
	    p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
	    return p;
	}, {});

    function transactionsStaticInfo() {
    	status = $('#status').val();
    	search = $('#search').val();
    	$.ajax({
            type: 'POST',
            url: '{{ route('admin.transactionsStatic.info') }}',
            data: {
                _token: '{{ csrf_token() }}',
                page: (!_GET['page']) ? 0 : _GET['page'],
                action: 'info',
                status: status,
                search: search
            },
            success: function(data) {
                $("#transactionsStaticInfo").html(data).slideDown();
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
    transactionsStaticInfo();
    setInterval(function() {
    	transactionsStaticInfo();
    }, 60000);

    $(document).on('change', '#status', function () {
        transactionsStaticInfo();
    });
    $(document).on('keyup', '#search', function () {
        if($(this).val() == '') {
            transactionsStaticInfo();
        }
    });
    $(document).on('click', '#searcher_btn', function () {
        transactionsStaticInfo();
    });
</script>
@endsection