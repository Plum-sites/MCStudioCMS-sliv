@extends('frontend.layouts.master')
@section('page_title', 'Восстановление пароля')
@section('body')
    <div class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert">
        <div class="alert-group-prepend">
            <span class="alert-group-icon text-">
                <i class="fa fa-info-circle"></i>
            </span>
        </div>
        <div class="alert-content">
            <strong style="font-weight:700;">
                Введите ваш почтовый ящик в поле ниже и получите ссылку на сброс пароля
            </strong>
        </div>
    </div>
    <form action="{{ route('forgot.pass') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <input type="text" name="email" class="form-control form-control-sm validate input-field {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="Введите ваш E-Mail" required>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-sm btn-primary w-100 mb-2">
                    Отправить заявку
                </button>
            </div>
        </div>
    </form>
@endsection