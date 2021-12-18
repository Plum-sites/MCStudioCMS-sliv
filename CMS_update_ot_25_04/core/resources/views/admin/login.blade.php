<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/quick-website.css') }}" id="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/frontend/upload/logo/icon.png') }}">
    <title>{{ $general->title }} - {{ $general->description }}</title>
    
</head>
<body>
    <section>
        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center min-vh-100">
                <div class="col-md-6 col-lg-5 col-xl-4 py-6 py-md-0">
                    <div>
                        <div class="mb-5 text-center">
                            <h6 class="h3 mb-1">Авторизация</h6>
                            <p class="text-muted mb-0">Введите данные от аккаунта администратора.</p>
                        </div>
                        <span class="clearfix"></span>
                        <form action="{{ route('admin.login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label">Логин</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control form-control-prepend" name="username" id="" placeholder="Логин">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <label class="form-control-label">Пароль</label>
                                    </div>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control form-control-prepend" name="password" id="input-password" placeholder="Пароль">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-block btn-primary">Войти</button></div>
                        </form>
                    </div>
                    @if(session()->has('error'))
                    <div class="has-session">
                        <strong style="color: #96000e">{{ session()->get('error') }}</strong>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="login-content">
        <h1 style="color:#fff;">{{ $general->title }}</h1>
        <div class="login-box">
            <form class="login-form" action="{{ route('admin.login') }}" method="post">
                @csrf
                <div class="form-group">
                    <input class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" type="text" name="username" value="{{ old('username') }}" placeholder="Логин" autofocus required>

                </div>
                <div class="form-group">
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="*******" required>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block" style="font-size: 17px;"><i></i>Авторизоваться</button>
                </div>
            </form>
        </div>
        @if(session()->has('error'))
        <div class="has-session">
            <strong style="color: #96000e">{{ session()->get('error') }}</strong>
        </div>
        @endif
    </section> --}}
    {{-- @include('admin.layouts.scripts') --}}
</body>
</html>