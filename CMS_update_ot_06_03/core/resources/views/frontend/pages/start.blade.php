@extends('frontend.layouts.master')
@section('page_title', 'Начать играть')
@section('body')
<div class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert">
	<div class="alert-group-prepend">
        <span class="alert-group-icon text-">
            <i class="fa fa-info-circle"></i>
        </span>
    </div>
    <div class="alert-content">
        <strong>
        	Привет! Cледуй шагам ниже, чтобы начать играть на нашем проекте!
        </strong>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card py-4 shadow-lg hover-translate-y-n10 hover-shadow-lg">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <div class="icon icon-sm bg-warning icon-shape">
                            <span class="h6 mb-0">1</span>
                        </div>
                    </div>
                    <div class="pl-3">
                        <h5 class="h4 mb-0">Первый шаг - это регистрация аккаунта</h5>
                    </div>
                </div>
                <p class="mt-4 mb-0">
	                @if(@Auth::user()->id)
	                <a href="#" class="btn btn-sm btn-primary btn-icon w-100">
                        <span class="btn-inner--text">{{ @Auth::user()->username }}</span>
                        <span class="btn-inner--icon">
                            <i class="fa fa-user"></i>
                        </span>
                    </a>
	                @else
	                <a href="#" data-toggle="modal" data-target="#modal_regs" class="btn btn-sm btn-primary btn-icon w-100">
	                    <span class="btn-inner--text">Зарегистрироваться</span>
	                    <span class="btn-inner--icon">
	                        <i class="fa fa-user-plus"></i>
	                    </span>
	                </a>
	                @endif
	            </p>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card py-4 shadow-lg hover-translate-y-n10 hover-shadow-lg">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <div class="icon icon-sm bg-warning icon-shape">
                            <span class="h6 mb-0">2</span>
                        </div>
                    </div>
                    <div class="pl-3">
                        <h5 class="h4 mb-0">Второй шаг - это загрузка лаунчера</h5>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <a href="{{ (!@$general->launcher_link) ? '/#' : @$general->launcher_link }}"  type="button" class="btn btn-app-store" style="color: white">
                        <i class="fab fa-windows"></i>
                        <span class="btn-inner--text">Скачать для </span>
                        <span class="btn-inner--brand">Windows</span>
                    </a>
                    <a  href="{{ (!@$general->launcher_link_jar) ? '/#' : @$general->launcher_link_jar }}" type="button" class="btn btn-app-store" style="color: white">
                        <i class="fab fa-apple"></i>
                        <span class="btn-inner--text">Скачать для </span>
                        <span class="btn-inner--brand">Mac OS X</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-12">
        <div class="card py-4 shadow-lg hover-translate-y-n10 hover-shadow-lg">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <div class="icon icon-sm bg-warning icon-shape">
                            <span class="h6 mb-0">3</span>
                        </div>
                    </div>
                    <div class="pl-3">
                        <h5 class="h4 mb-0">Мы на связи</h5>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <a href="{{ (!@$general->vk_group_id ? '/#' : @$general->vk_group_id) }}"  type="button" class="btn btn-app-store" style="color: white">
                        <i class="fab fa-windows"></i>
                        <span class="btn-inner--text">Скачать для </span>
                        <span class="btn-inner--brand">Windows</span>
                    </a>
                    <a  href="{{ (!@$general->launcher_link_jar) ? '/#' : @$general->launcher_link_jar }}" type="button" class="btn btn-app-store" style="color: white">
                        <i class="fab fa-apple"></i>
                        <span class="btn-inner--text">Скачать для </span>
                        <span class="btn-inner--brand">Mac OS X</span>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
</div>
<!-- <div class="row">
    <div class="col-12">
    	<div class="card py-4 shadow-lg hover-translate-y-n10 hover-shadow-lg">
    		<div class="text-center">
    			С нами уже {{ App\User::count('id') }} игроков, 
    		</div>
    	</div>
    </div>
</div> -->
@endsection