@extends('frontend.layouts.master-alternate')
@section('page_title', 'Личный кабинет')
@section('body')
@if(@Auth::user()->id)
<div class="table-responsive">
	<ul class="nav nav-tabs mt-0 w-100" role="tablist" style="visibility: visible;">
		<li class="nav-item p-0 mt-0 mb-0 font-weight-bold">
			<a class="nav-link active" href="#menu1" data-toggle="tab" role="tab" aria-selected="false">Персонализация</a>
		</li>
		<li class="nav-item p-0 mt-0 mb-0 font-weight-bold">
			<a class="nav-link" href="#menu2" data-toggle="tab" role="tab" aria-selected="false">Привилегии</a>
		</li>
		@if(@$general->sw_prefixes == 'true')
		<li class="nav-item p-0 mt-0 mb-0 font-weight-bold">
			<a class="nav-link" href="#menu3" data-toggle="tab" role="tab" aria-selected="false">Префикс</a>
		</li>
		@endif
		@if(@$general->sw_kits == 'true')
		<li class="nav-item p-0 mt-0 mb-0 font-weight-bold">
			<a class="nav-link" href="#menu4" data-toggle="tab" role="tab" aria-selected="false">Наборы</a>
		</li>
		@endif
		<li class="nav-item p-0 mt-0 mb-0 font-weight-bold">
			<a class="nav-link" href="#menu5" data-toggle="tab" role="tab" aria-selected="false">Настройки</a>
		</li>
		<li class="nav-item p-0 mt-0 mb-0 font-weight-bold ml-auto">
			<button data-toggle="modal" data-target="#modal_cash" class="btn btn-primary btn-sm">Баланс: {{ (@Auth::user()->balance_real) ? Auth::user()->balance_real : '0' }} <i class="fa fa-ruble-sign" data-toggle="tooltip" data-placement="left" title="Реальная валюта"></i></button>
		</li>
		<div style="clear:both;"></div>
	</ul>
</div>
<div class="tab-content p-0">
	<div id="menu1" class="container p-0 mt-3 tab-pane active">
		@include('frontend.pages.cabinet-menu1')
	</div>
	<div id="menu2" class="container p-0 mt-3 tab-pane fade">
		@include('frontend.pages.cabinet-menu2')
	</div>
	@if(@$general->sw_prefixes == 'true')
	<div id="menu3" class="container p-0 mt-3 tab-pane fade">
		@include('frontend.pages.cabinet-menu3')
	</div>
	@endif
	@if(@$general->sw_kits == 'true')
	<div id="menu4" class="container p-0 mt-3 tab-pane fade">
		@include('frontend.pages.cabinet-menu4')
	</div>
	@endif
	<div id="menu5" class="container p-0 mt-3 tab-pane fade">
		@include('frontend.pages.cabinet-menu5')
	</div>
</div>
<script type="text/javascript">

</script>
@else
<div class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert">
	<div class="alert-group-prepend">
        <span class="alert-group-icon text-">
            <i class="fa fa-times"></i>
        </span>
    </div>
    <div class="alert-content">
        <strong>
        	Данная страница доступна только авторизованным пользователям
        </strong>
    </div>
</div>
@endif
@endsection