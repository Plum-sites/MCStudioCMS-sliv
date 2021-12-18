<footer class="position-relative" id="footer-main">
    <div class="footer pt-lg-7 footer-dark bg-dark">
        <!-- SVG shape -->
        <div class="shape-container shape-line shape-position-top shape-orientation-inverse">
            <svg width="2560px" height="100px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve" class="">
                <polygon points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
        <!-- Footer -->
        <div class="container pt-4">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h3 class="text-secondary mb-2">{{ @$general->title }}</h3>
                            <p class="lead mb-0 text-white opacity-8">
                                {{ @$general->description }}
                            </p>
                        </div>
                        @if(@Auth::user()->id)
                        <div class="col-lg-6 text-lg-right mt-4 mt-lg-0">
                            @if(@$general->sw_shop == 'true')
                            <a href="{{ route('storets') }}" class="btn btn-white btn-icon my-2">
                                <span class="btn-inner--text">Онлайн магазин</span>
                                <span class="btn-inner--icon">
                                    <i class="fa fa-shopping-cart"></i>
                                </span>
                            </a>
                            @endif
                            <a href="{{ route('cabinet') }}" class="btn btn-primary btn-icon my-2">
                                <span class="btn-inner--text">Личный кабинет </span>
                                <span class="btn-inner--icon">
                                    <i class="fa fa-street-view"></i>
                                </span>
                            </a>
                        </div>
                        @else
                        <div class="col-lg-5 text-lg-right mt-4 mt-lg-0">
                            <a href="{{ route('start') }}" class="btn btn-white btn-icon my-2">
                                <span class="btn-inner--text">Начать играть</span>
                                <span class="btn-inner--icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <hr class="divider divider-fade divider-dark my-4">
            <div class="row align-items-center justify-content-md-between pb-4">
                <div class="col-md-6">
                    <div class="copyright text-sm font-weight-bold text-center text-md-left">
                        &copy; <a href="/" class="font-weight-bold" target="_blank">{{ @$general->title }}</a> 2021
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="nav justify-content-center justify-content-md-end mt-3 mt-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                Главная
                            </a>
                        </li>
                        @if(@Auth::user()->id)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('start') }}">
                                Начать играть
                            </a>
                        </li>
                        @endif
                        {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('rules') }}">
                            Правила
                        </a>
                    </li> --}}
                    @if(@$general->sw_banlist == 'true')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('banlist') }}">
                            Банлист
                        </a>
                    </li>
                    @endif
                    @if(@$general->sw_ratings == 'true')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ratings') }}">
                            Рейтинг
                        </a>
                    </li>
                    @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</footer>