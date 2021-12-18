<?php
$path = explode("/", @request()->path());
?>
<nav class="navbar navbar-main navbar-expand-lg navbar-light shadow" id="navbar-main">
    <div class="container">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-overlay" id="navbar-main-collapse">

            <!-- Toggler --> 
            <div class="position-relative">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i data-feather="x"></i>
                </button>
            </div>

    <ul class="navbar-nav ml-lg-auto">
        <li class="nav-item nav-item-spaced d-none d-lg-block">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                Главная
            </a>
        </li>
        <li class="nav-item nav-item-spaced dropdown dropdown-animate">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                Информация
            </a>
            <div class="dropdown-menu dropdown-menu-md p-0">
                <div class="list-group list-group-flush px-lg-4">
                    <a href="{{ route('admin.serversList') }}" class="list-group-item list-group-item-action" role="button">
                        <div class="d-flex">
                            <!-- SVG icon -->
                            <span class="h6">
                                <i data-feather="file-text"></i>
                            </span>
                            <!-- Media body -->
                            <div class="ml-3">
                                <h6 class="heading mb-0">Список серверов</h6>
                                <small class="text-sm">Управление серверами проекта</small>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item nav-item-spaced dropdown dropdown-animate">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                Личный кабинет
            </a>
            <div class="dropdown-menu dropdown-menu-md p-0">
                <div class="list-group list-group-flush px-lg-4">
                    <a href="{{ route('admin.privilegesList') }}" class="list-group-item list-group-item-action" role="button">
                        <div class="d-flex">
                            <!-- SVG icon -->
                            <span class="h6">
                                <i data-feather="file-text"></i>
                            </span>
                            <!-- Media body -->
                            <div class="ml-3">
                                <h6 class="heading mb-0">Список привилегий</h6>
                                <small class="text-sm">Управление привилегиями проекта</small>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.kitsList') }}" class="list-group-item list-group-item-action" role="button">
                        <div class="d-flex">
                            <!-- SVG icon -->
                            <span class="h6">
                                <i data-feather="file-text"></i>
                            </span>
                            <!-- Media body -->
                            <div class="ml-3">
                                <h6 class="heading mb-0">Список кит наборов</h6>
                                <small class="text-sm">Управление наборами проекта</small>
                            </div>
                        </div>
                    </a>
                </div>
        </li>
        <li class="nav-item nav-item-spaced dropdown dropdown-animate">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                Магазин блоков
            </a>
            <div class="dropdown-menu dropdown-menu-md p-0">
                <div class="list-group list-group-flush px-lg-4">
                    <a href="{{ route('admin.categorysList') }}" class="list-group-item list-group-item-action" role="button">
                        <div class="d-flex">
                            <!-- SVG icon -->
                            <span class="h6">
                                <i data-feather="file-text"></i>
                            </span>
                            <!-- Media body -->
                            <div class="ml-3">
                                <h6 class="heading mb-0">Список категорий</h6>
                                <small class="text-sm">Управление категориями магазина</small>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.itemsList') }}" class="list-group-item list-group-item-action" role="button">
                        <div class="d-flex">
                            <!-- SVG icon -->
                            <span class="h6">
                                <i data-feather="file-text"></i>
                            </span>
                            <!-- Media body -->
                            <div class="ml-3">
                                <h6 class="heading mb-0">Список предметов</h6>
                                <small class="text-sm">Управление предметами магазина</small>
                            </div>
                        </div>
                    </a>
                </div>
        </li>
        <li class="nav-item nav-item-spaced dropdown dropdown-animate">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                Пользователи
            </a>
            <div class="dropdown-menu dropdown-menu-md p-0">
                <div class="list-group list-group-flush px-lg-4">
                    <a href="{{ route('admin.usersList') }}" class="list-group-item list-group-item-action" role="button">
                        <div class="d-flex">
                            <!-- SVG icon -->
                            <span class="h6">
                                <i data-feather="file-text"></i>
                            </span>
                            <!-- Media body -->
                            <div class="ml-3">
                                <h6 class="heading mb-0">Список пользователей</h6>
                                <small class="text-sm">Управление пользователями проекта</small>
                            </div>
                        </div>
                    </a>
                </div>
        </li>
        <li class="nav-item nav-item-spaced dropdown dropdown-animate">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                Основные настройки
            </a>
            <div class="dropdown-menu dropdown-menu-md p-0">
                <div class="list-group list-group-flush px-lg-4">
                    <a href="{{ route('admin.settingList') }}" class="list-group-item list-group-item-action" role="button">
                        <div class="d-flex">
                            <!-- SVG icon -->
                            <span class="h6">
                                <i data-feather="file-text"></i>
                            </span>
                            <!-- Media body -->
                            <div class="ml-3">
                                <h6 class="heading mb-0">Настройки сайта</h6>
                                <small class="text-sm">Управление главными найстроками</small>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.gatewaysList') }}" class="list-group-item list-group-item-action" role="button">
                        <div class="d-flex">
                            <!-- SVG icon -->
                            <span class="h6">
                                <i data-feather="file-text"></i>
                            </span>
                            <!-- Media body -->
                            <div class="ml-3">
                                <h6 class="heading mb-0">Настройки платежной системы</h6>
                                <small class="text-sm">Настройка и подключение Unitpay или Freekassa</small>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.ratingsList') }}" class="list-group-item list-group-item-action" role="button">
                        <div class="d-flex">
                            <!-- SVG icon -->
                            <span class="h6">
                                <i data-feather="file-text"></i>
                            </span>
                            <!-- Media body -->
                            <div class="ml-3">
                                <h6 class="heading mb-0">Настройки систем голосования</h6>
                                <small class="text-sm">Настройка MCRate и TopCraft</small>
                            </div>
                        </div>
                    </a>
                    {{-- <a href="{{ route('admin.smtp') }}" class="list-group-item list-group-item-action" role="button">
                        <div class="d-flex">
                            <!-- SVG icon -->
                            <span class="h6">
                                <i data-feather="file-text"></i>
                            </span>
                            <!-- Media body -->
                            <div class="ml-3">
                                <h6 class="heading mb-0">Настройки SMTP</h6>
                                <small class="text-sm">Отправка писем с оповещениями</small>
                            </div>
                        </div>
                    </a> --}}
                    <a href="{{ route('admin.promosList') }}" class="list-group-item list-group-item-action" role="button">
                        <div class="d-flex">
                            <!-- SVG icon -->
                            <span class="h6">
                                <i data-feather="file-text"></i>
                            </span>
                            <!-- Media body -->
                            <div class="ml-3">
                                <h6 class="heading mb-0">Настройки промокодов</h6>
                                <small class="text-sm">Промокоды для привилегий, наборов и предметов</small>
                            </div>
                        </div>
                    </a>
                </div>
        </li>
        <li class="nav-item nav-item-spaced d-none d-lg-block">
            <a class="nav-link" href="{{ route('admin.logout') }}">
                Выйти из аккаунта
            </a>
        </li>
    </ul>
                </div>
            </div>
</nav>