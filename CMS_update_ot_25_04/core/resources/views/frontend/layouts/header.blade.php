<!-- Header -->
<meta name="verification" content="48e00e5756c316bdc294745dff6809" />
<header class="" id="header-main">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg shadow navbar-light" id="navbar-main">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('dashboard') }}" style="font-size:18pt; font-weight: bold; text-transform: uppercase">
                {!! (@$general->site_offline) ? '<span class="badge badge-danger" style="font-size:16pt;padding:0px 5px;" data-toggle="tooltip" data-placement="right" title="Включен режим offline">OFF</span>' : '' !!}
                {{ $general->title }}
            </a>
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapse -->
            <div class="collapse navbar-collapse navbar-collapse-overlay" id="navbar-main-collapse">
                <!-- Toggler -->
                <div class="position-relative">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- Main navigation -->
                <ul class="navbar-nav ml-lg-auto">
                    {{-- <li class="nav-item  dropdown dropdown-animate" data-toggle="hover">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Наши сервера</a>
                        <div class="dropdown-menu dropdown-menu-md p-0">
                            <div class="list-group list-group-flush px-lg-4">
                                <a href="#" class="list-group-item list-group-item-action" role="button">
                                    <div class="d-flex">
                                        <!-- Media body -->
                                        <div>
                                            <h6 class="heading mb-0">Наши сервера</h6>
                                            <small class="text-sm">Выбери себе сервер по вкусу</small>
                                        </div>
                                    </div>
                                </a>
                
                                <div class="py-3">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="{{ route('start') }}" class="dropdown-item">Server</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li> --}}
                    @if(@Auth::user()->id)
                    <li class="nav-item  d-lg-block">
                        <a class="nav-link" href="{{ route('start') }}">
                            Начать играть 
                        </a>
                    </li>
                    @endif
                    <li class="nav-item  d-lg-block">
                        <a class="nav-link" href="{{ route('rules') }}">
                            Правила
                        </a>
                    </li>
                    <li class="nav-item  d-lg-block ">
                        <a class="nav-link text-warning" href="{{ route('donate') }}">
                            Донат <i class="fas fa-coins"></i>
                        </a>
                    </li> 
                    @if(@$general->sw_banlist == 'true')
                    <li class="nav-item  d-lg-block">
                        <a class="nav-link" href="{{ route('banlist') }}">
                            Банлист
                        </a>
                    </li> 
                    @endif
                    @if(@$general->sw_ratings == 'true')
                    <li class="nav-item  d-lg-block">
                        <a class="nav-link" href="{{ route('ratings') }}">
                            Рейтинг
                        </a>
                    </li>
                    @endif
                </ul>
                <!-- Right navigation -->
                <ul class="navbar-nav align-items-lg-center d-lg-flex ml-lg-auto">
                    @if(@Auth::user()->id)
                    <li class="nav-item">
                        <a href="#" data-toggle="modal" data-target="#modal_cash" title="Пополнить баланс" style="font-weight: bold">
                            {{ (@Auth::user()->balance_real) ? Auth::user()->balance_real : '0' }} <i class="fa fa-ruble-sign" data-toggle="tooltip" data-placement="left" title="Реальная валюта"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="profile-link" data-toggle="modal" data-target="#modal_nav">
                            <img width="35px" style="border-radius: 50%" src="/view.php?user={{ (!@Auth::user()->username) ? 'default' : @Auth::user()->username }}&mode=3&size=35" alt="">
                            {{ @Auth::user()->username }}
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="#" data-toggle="modal" data-target="#modal_auth" class="nav-link">
                            Вход на сайт
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" data-toggle="modal" data-target="#modal_regs" class="btn btn-sm btn-primary btn-icon">
                            <span class="btn-inner--text">Регистрация</span>
                            <span class="btn-inner--icon">
                                <i class="fa fa-user-plus"></i>
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>
                <!-- Mobile button -->
                <div class="d-lg-none px-4">
                    @if(@Auth::user()->id)
                    <a href="#" data-toggle="modal" data-target="#modal_cash" class="btn btn-block btn-sm btn-primary mr-0 ml-0">
                        Баланс
                    </a>
                    @endif
                </div>
                
            </div>
        </div>
    </nav>
</header>
<section class="slice bg-section-dark">
    <div data-offset-top="#navbar-main">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <!-- Surtitle -->
                    <h6 class="text-white">
                        
                        {{ @$general->title }} - {{ @$general->description }}
                    </h6>
                    <!-- Heading -->
                    <h1 class="display-4 text-white font-weight-bolder mb-4">
                        Добро пожаловать
                        <br>
                        <strong class="d-block text-primary font-weight-bold h2">
                            <!-- Присоединяйся к нам! -->
                            Начни играть прямо сейчас
                        </strong>
                    </h1>
                    <div class="mt-3">
                        @if(@Auth::user()->id)
                        
                        <a href="{{ route('cabinet') }}" class="btn btn-primary btn-icon ml-0 mt-2">
                            <span class="btn-inner--text">Личный кабинет</span>
                            <span class="btn-inner--icon">
                                <i class="fa fa-street-view"></i>
                            </span>
                        </a>
                        @if(@$general->sw_shop == 'true')
                        <a href="{{ route('storets') }}" class="btn btn-white btn-icon ml-0 ml-lg-2 mt-2">
                            <span class="btn-inner--text">Онлайн магазин</span>
                            <span class="btn-inner--icon">
                                <i class="fa fa-shopping-cart"></i>
                            </span>
                        </a>
                        @endif
                        @else
                        <a href="{{ route('rules') }}" class="btn btn-primary btn-icon ml-0 mt-2">
                            <span class="btn-inner--text">Правила</span>
                            <span class="btn-inner--icon">
                                <i class="fa fa-book"></i>
                            </span>
                        </a>
                        <a href="{{ route('start') }}" class="btn btn-white btn-icon ml-0 ml-lg-2 mt-2">
                            <span class="btn-inner--text">Начать играть</span>
                            <span class="btn-inner--icon">
                                <i class="fa fa-arrow-right"></i>
                            </span>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-6 mt-4 mb-4">
                    <div class="row">
                        <div class="col-6">
                            <script type="text/javascript" src="https://vk.com/js/api/openapi.js?168"></script>
                            <!-- VK Widget -->
                            <div id="vk_groups" style="width: 100%"></div>
                            <script type="text/javascript">
                            VK.Widgets.Group("vk_groups", {mode: 4, width: 'auto', height: '350'}, {{ @$general->vk_group_id }});
                            </script>
                        </div>
                        
                        @if (@$general->discord_server_id)
                        <div class="col-6">
                            <iframe src="https://discordapp.com/widget?id={{ @$general->discord_server_id }}&theme=dark" width="100%" height="350" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
                        </div>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- SVG separator -->
    <div class="shape-container shape-line shape-position-bottom zindex-102">
        <svg width="2560px" height="100px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve" class="">
            <polygon points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</section>