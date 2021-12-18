<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{ $general->description }}">
    <meta name="keywords" content="smm">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">
    <title>{{ $general->title }} - {{ $general->description }} {{ (@$general->site_offline) ? '(Offline)' : '' }}</title>
    <meta name="robots" content="all,follow">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta property="og:url">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $general->title }}">
    <meta property="og:site_name" content="{{ $general->title }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    @include('admin.layouts.styles')
</head>
<body>
    <header class="" id="header-main"><!-- Navbar -->
    @include('admin.layouts.navbar')
    
    </header>
    <section class="slice py-5 bg-section-fade">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col">
        <h1 class="h4 mb-0">
            @yield('page_name')
        </h1>
    </div>
</div>
<div class="card mb-3 p-4">
        @section('body')
        @show
</div>
        </div>
    </section>
    @include('admin.layouts.scripts')
    <script type="text/javascript">
        var csrf_token = '{{ csrf_token() }}';
        $(document).ready(function() {
            $('meta[name="csrf-token"]').val(csrf_token).attr('content', csrf_token);
            $('.captcha-image').attr('src', '/captcha/image?X-CSRF-Token='+csrf_token+'&_token='+csrf_token).slideDown(1000);
            $(document).on('click', '.captcha-image', function(e) {
                $('.captcha-image').attr('src', '/captcha/image?X-CSRF-Token='+csrf_token+'&_token='+csrf_token).slideDown(1000);
                $('[name="captcha"]').val('');
            });
        });
        $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
    </script>
    @yield('scripts')
</body>
</html>