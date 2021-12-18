@extends('frontend.layouts.master')
@section('page_title', 'Рейтинг игроков')
@section('body')
@if(@Auth::user()->id)
	<div class="alert alert-group alert-primary alert-dismissible fade show alert-icon mt-1" role="alert">
		<div class="alert-group-prepend">
	        <span class="alert-group-icon text-">
	            <i class="fa fa-info-circle"></i>
	        </span>
	    </div>
	    <div class="alert-content">
	        <strong>
	        	Голосуй за нас в специальных рейтингах и получай бонусы, жми на кнопки и голосуй!
	        </strong>
	    </div>
	</div>
	<div class="col-md-12 p-0">
		<div class="row">
			<div class="col-lg-6 col-md">
		        <div class="card card-pricing text-center px-3 mb-3">
		            <div class="card-header py-2 border-0 delimiter-bottom">
	                    <div style="padding:15px;background-image:radial-gradient(circle,rgb(255 153 0 / 21%) 0,#e2e8f000 70%);">
	                        <i class="fas fa-chart-line" style="font-size:50pt;"></i>
	                    </div>
		                <div class="h6 text-center mb-0">McRate</div>
		            </div>
	                <span class="h7 text-muted mt-2">
	                	Получите {{ @$ratings->vote_gift_count }}
	                	@if(@$ratings->vote_gift_type == 1)
	                	<i class="fab fa-bitcoin" data-toggle="tooltip" data-placement="top" title="Биткоины для обмена"></i>
	                	@endif
	                	@if(@$ratings->vote_gift_type == 2)
	                	<i class="fa fa-ruble-sign" data-toggle="tooltip" data-placement="top" title="Реальная валюта"></i>
	                	@endif
	                	@if(@$ratings->vote_gift_type == 3)
	                	<i class="fa fa-archive" data-toggle="tooltip" data-placement="top" title="Набор на сервера"></i>
	                	@endif
	                </span>
	                <div class="row mt-2">
		                <div class="col-md-12">
		                  <a href="{{ (!@$ratings->link_mcrate) ? '#' : @$ratings->link_mcrate }}" target="_Blank" class="btn btn-sm btn-primary mb-3 w-100">
		                    Проголосовать
		                  </a>
		                </div>
	                </div>
		        </div>
		    </div>
			<div class="col-lg-6 col-md">
		        <div class="card card-pricing text-center px-3 mb-3">
		            <div class="card-header py-2 border-0 delimiter-bottom">
	                    <div style="padding:15px;background-image:radial-gradient(circle,rgb(255 153 0 / 21%) 0,#e2e8f000 70%);">
	                        <i class="fas fa-chart-line" style="font-size:50pt;"></i>
	                    </div>
		                <div class="h6 text-center mb-0">TopCraft</div>
		            </div>
	                <span class="h7 text-muted mt-2">
	                	Получите {{ @$ratings->vote_gift_count }}
	                	@if(@$ratings->vote_gift_type == 1)
	                	<i class="fab fa-bitcoin" data-toggle="tooltip" data-placement="top" title="Биткоины для обмена"></i>
	                	@endif
	                	@if(@$ratings->vote_gift_type == 2)
	                	<i class="fa fa-ruble-sign" data-toggle="tooltip" data-placement="top" title="Реальная валюта"></i>
	                	@endif
	                	@if(@$ratings->vote_gift_type == 3)
	                	<i class="fa fa-archive" data-toggle="tooltip" data-placement="top" title="Набор на сервера"></i>
	                	@endif
	                </span>
	                <div class="row mt-2">
		                <div class="col-md-12">
		                  <a href="{{ (!@$ratings->link_topcraft) ? '#' : @$ratings->link_topcraft }}" target="_Blank" class="btn btn-sm btn-primary mb-3 w-100">
		                    Проголосовать
		                  </a>
		                </div>
	                </div>
		        </div>
		    </div>
		    {{-- <div class="col-lg-4 col-md">
		        <div class="card card-pricing text-center px-3 mb-3">
		            <div class="card-header py-2 border-0 delimiter-bottom">
	                    <div style="padding:15px;background-image:radial-gradient(circle,rgb(255 153 0 / 21%) 0,#e2e8f000 70%);">
	                        <i class="fas fa-chart-line" style="font-size:50pt;"></i>
	                    </div>
		                <div class="h6 text-center mb-0">MinecraftRating</div>
		            </div>
	                <span class="h7 text-muted mt-2">
	                	Получите {{ @$ratings->vote_gift_count }}
	                	@if(@$ratings->vote_gift_type == 1)
	                	<i class="fab fa-bitcoin" data-toggle="tooltip" data-placement="top" title="Биткоины для обмена"></i>
	                	@endif
	                	@if(@$ratings->vote_gift_type == 2)
	                	<i class="fa fa-ruble-sign" data-toggle="tooltip" data-placement="top" title="Реальная валюта"></i>
	                	@endif
	                	@if(@$ratings->vote_gift_type == 3)
	                	<i class="fa fa-archive" data-toggle="tooltip" data-placement="top" title="Набор на сервера"></i>
	                	@endif
	                </span>
	                <div class="row mt-2">
		                <div class="col-md-12">
		                  <a href="{{ (!@$ratings->link_minecraftrating) ? '#' : @$ratings->link_minecraftrating }}" target="_Blank" class="btn btn-sm btn-primary mb-3 w-100">
		                    Проголосовать
		                  </a>
		                </div>
	                </div>
		        </div>
		    </div> --}}
		</div>
	</div>
	@if(@$ratings->vote_gift_type == 1)
	<div class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert">
		<div class="alert-group-prepend">
	        <span class="alert-group-icon text-">
	            <i class="fab fa-bitcoin"></i>
	        </span>
	    </div>
	    <div class="alert-content">
	        <strong>
	        	Биткоины - используются для обмена на игровую валюту на наши сервера
	        </strong>
	    </div>
	</div>
	@endif
	@if(@$ratings->vote_gift_type == 2)
	<div class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert">
		<div class="alert-group-prepend">
	        <span class="alert-group-icon text-">
	            <i class="fa fa-ruble-sign"></i>
	        </span>
	    </div>
	    <div class="alert-content">
	        <strong>
	        	Реальная валюта - используется для всяких покупок на нашем сайте
	        </strong>
	    </div>
	</div>
	@endif
	@if(@$ratings->vote_gift_type == 3)
	<div class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert">
		<div class="alert-group-prepend">
	        <span class="alert-group-icon text-">
	            <i class="fa fa-archive"></i>
	        </span>
	    </div>
	    <div class="alert-content">
	        <strong>
	        	Набор - используется для обмена на игровой кит набор на наши сервера
	        </strong>
	    </div>
	</div>
	@endif
@else
	<div class="alert alert-group alert-primary alert-dismissible fade show alert-icon mt-1" role="alert">
		<div class="alert-group-prepend">
	        <span class="alert-group-icon text-">
	            <i class="fa fa-info-circle"></i>
	        </span>
	    </div>
	    <div class="alert-content">
	        <strong>
	        	Авторизуйтесь в свой аккаунт, чтобы голосовать, получать бонусы и обменивать их
	        </strong>
	    </div>
	</div>
@endif
<div class="table-responsive">
	<ul class="nav nav-tabs mt-0 w-100" role="tablist" style="visibility: visible;">
		<li class="nav-item p-0 mt-0 mb-0 font-weight-bold">
			<a class="nav-link active" href="#menu1" data-toggle="tab" role="tab" aria-selected="false">РЕЙТИНГ ИГРОКОВ</a>
		</li>
		<li class="nav-item p-0 mt-0 mb-0 font-weight-bold">
			<a class="nav-link {{ (!@Auth::user()->id) ? 'disabled' : '0' }}" href="#menu2" data-toggle="tab" role="tab" aria-selected="false">ОБМЕН БОНУСОВ</a>
		</li>
		<div style="clear:both;"></div>
	</ul>
</div>
<div class="tab-content p-0">
	<div id="menu1" class="container p-0 mt-3 tab-pane active">
		@include('frontend.pages.ratings-menu1')
	</div>
	<div id="menu2" class="container p-0 mt-3 tab-pane fade">
		@include('frontend.pages.ratings-menu2')
	</div>
</div>
<style type="text/css">
	.rating-num {
		padding: 2px;
	}
	.rating-num > .rating-num-1 {
		padding: 0px 6px;
		border: 2px solid red;
		border-radius: 300px;
		position: relative;
		right: 6px;
		clip-path: circle(50% at center center);
	}
	.rating-num > .rating-num-2 {
		padding: 0px 6px;
		border: 2px solid orange;
		border-radius: 300px;
		position: relative;
		right: 6px;
		clip-path: circle(50% at center center);
	}
	.rating-num > .rating-num-3 {
		padding: 0px 6px;
		border: 2px solid #008aff;
		border-radius: 300px;
		position: relative;
		right: 6px;
		clip-path: circle(50% at center center);
	}
</style>
@endsection