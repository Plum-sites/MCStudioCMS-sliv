@extends('frontend.layouts.master')
@section('page_title', 'Сброс пароля')
@section('body')
    <div class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert">
        <div class="alert-group-prepend">
            <span class="alert-group-icon text-">
                <i class="fa fa-info-circle"></i>
            </span>
        </div>
        <div class="alert-content">
            <strong style="font-weight:700;">
                Введите новый пароль для вашего аккаунта, он должен отличаться от старого!
            </strong>
        </div>
    </div>
    <form action="{{ route('reset.pass') }}" method="post">
        @csrf
        <input type="hidden" value="{{$reset->token}}" name="token"/>
        <div class="row">
            <div class="col-md-4">
                <input type="password" name="password" class="form-control form-control-sm validate input-field {{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" placeholder="Новый пароль" required>
            </div>
            <div class="col-md-4">
                <input type="password" name="password_confirmation" class="form-control form-control-sm validate input-field {{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password_confirmation') }}" placeholder="Повторите пароль" required>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-sm btn-primary w-100 mb-2">
                    Сменить пароль
                </button>
            </div>
        </div>
    </form>
@endsection