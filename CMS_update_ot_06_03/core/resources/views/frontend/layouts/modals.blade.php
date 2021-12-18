@if(!@Auth::user()->id)
<div class="modal mt-5" id="modal_auth" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content m-auto p-0" style="margin-top:25px !important;">
                <div class="p-5">
                    <div>
                <div class="mb-5 text-center">                    <button type="button" class="close" style="color:#000;" data-dismiss="modal"  aria-label="Close" aria-expanded="false">
                    <i class="fa fa-times"></i>
                </button>
                    <h6 class="h3 mb-1">Авторизация</h6><p class="text-muted mb-0">Войдите в свой аккаунт, чтобы продолжить.</p></div>

                <span class="clearfix"></span>
                <form id="form_auth" action="#" method="POST">
                    @csrf
                <div class="form-group">
                    <label class="form-control-label">Логин</label>
                    <div class="input-group input-group-merge">
                        <input type="text" name="username" class="form-control form-control-prepend validate" placeholder="Ваш логин">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <label class="form-control-label">Пароль</label>
                        </div>
                    </div>
                    <div class="input-group input-group-merge">
                        <input type="password" name="password" class="form-control form-control-prepend validate" id="input-password" placeholder="Пароль">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <label class="form-control-label">Капча</label>
                        </div>
                    </div>
                    <img class="captcha-image mb-2" style="display:none;width:100%;height:39px;border-radius:5px;cursor:pointer;" title="Нажмите чтобы обновить">
                    <div class="input-group input-group-merge">
                        <input type="text" name="captcha" class="form-control form-control-prepend validate" id="input-password" placeholder="Код с картинки">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-text-width" style="margin:0 auto;"></i></span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button type="button" id="button_auth" class="btn btn-block btn-primary">Войти</button></div>
            </form>
            
                <div class="py-3 text-center">
                    <span class="text-xs text-uppercase">Или</span>
                </div>
                <!-- Alternative login -->
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('login.vk.link') }}" class="btn btn-block btn-neutral btn-icon mb-3 mb-sm-0">
                            <span class="btn-inner--icon"><img src="../../assets/img/icons/brands/vk.svg" alt="Image placeholder"></span>
                            <span class="btn-inner--text">Войти через VK</span>
                        </a>
                    </div>
                </div>
                
                <!-- Links -->
                <div class="mt-4 text-center"><small>Забыли пароль?</small>
                    <a href="{{ route('password.request') }}" class="small font-weight-bold">Восстановить</a></div>
            </div>
            
                </div>
        </div>
    </div>
</div>
<div class="modal" id="modal_regs" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content m-auto" style="margin-top:25px !important;">
            <form id="form_regs" action="#" method="POST">
                @csrf
                <div class="p-5">
                    <div class="mb-5 text-center">
                        <button type="button" class="close" style="color:#000;" data-dismiss="modal"  aria-label="Close" aria-expanded="false">
                            <i class="fa fa-times"></i>
                        </button>
                        <h6 class="h3 mb-1">Регистрация</h6>
                        <p class="text-muted mb-0">Присоединяйтесь к нам и играйте на качественных серверах</p>
                    </div>
                    <span class="clearfix"></span>
                    <form>
                        <div class="form-group">
                            <label class="form-control-label">Ник</label>
                            <div class="input-group input-group-merge">
                                <input type="text" name="username" class="form-control form-control-prepend validate" id="input-name" placeholder="Введите ник">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Email</label>
                            <div class="input-group input-group-merge">
                                <input type="email" name="email" class="form-control form-control-prepend validate" id="input-email" placeholder="Ваша почта">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-at"></i></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <label class="form-control-label">Пароль</label>
                                </div>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password" class="form-control form-control-prepend validate" placeholder="********">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <label class="form-control-label">Повторить пароль</label>
                                </div>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" name="password_confirmation" class="form-control form-control-prepend validate" placeholder="********">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <label class="form-control-label">Капча</label>
                                </div>
                            </div>
                            <img class="captcha-image mb-2" style="display:none;width:100%;height:39px;border-radius:5px;cursor:pointer;" title="Нажмите чтобы обновить">
                            <div class="input-group input-group-merge">
                                <input type="text" name="captcha" class="form-control form-control-prepend validate" placeholder="Код с картинки">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-width" style="margin:0 auto;"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="my-4">
                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" class="custom-control-input" id="check-terms">
                                <label class="custom-control-label" for="check-terms">Я согласен с <a href="{{ route('rules') }}">правилами проекта</a></label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="button" id="button_regs" class="btn btn-block btn-primary">Зарегистрироваться</button>
                        </div>
                    </form>
                </div>
                <div id="regs_step_2" class="modal-body" style="display:none;">
                    <div class="col-md-12 p-0 m-0">
                        <div class="md-form col-md-12 mb-1">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                      <i class="fa fa-code"></i>
                                  </div>
                                </div>
                                <input type="text" name="codes_verify" class="form-control validate" placeholder="Проверочный код">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer d-flex justify-content-center">
                    <button type="button" id="button_regs" class="btn btn-sm btn-primary w-100 mr-3 ml-3">Зарегистрироваться</button>
                </div> -->
            </form>
        </div>
    </div>
</div>
@else
<div class="modal mt-5" id="modal_nav" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content m-auto" style="margin-top:25px !important;">
            <div class="modal-header text-center">
                <span class="modal-title w-100 text-left text-dark" style="font-size:17px;">Навигация</span>
                <button type="button" class="close" style="color:#000;" data-dismiss="modal"  aria-label="Close" aria-expanded="false">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if(@Auth::user()->access == 1)
                    <div class="col-md-12">
                        <a href="/admin" class="btn btn-sm btn-warning mb-2 w-100">
                            <i class="fa fa-cog" style="display:inline-block;"></i>
                            Админ панель
                        </a>
                    </div>
                    @endif
                    <div class="col-md-12">
                        <a href="{{ route('cabinet') }}" class="btn btn-sm btn-primary mb-2 w-100">
                            <i class="fa fa-street-view" style="display:inline-block;"></i>
                            Личный кабинет
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a href="{{ route('storets') }}" class="btn btn-sm btn-primary mb-2 w-100">
                            <i class="fa fa-shopping-cart" style="display:inline-block;"></i>
                            Онлайн магазин
                        </a>
                    </div>
                    @if(@Auth::user()->vk_id == 0)
                    <div id="vk_bind_btn" class="col-md-12">
                        <a href="{{ route('login.vk.bind') }}" class="btn btn-sm btn-primary mb-2 w-100">
                            <i class="fab fa-vk"></i>
                            Привязать аккаунт
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-sm btn-danger w-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-power-off" style="display:inline-block;"></i>
                    Покинуть аккаунт
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal mt-5" id="modal_cash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content m-auto" style="margin-top:25px !important;">
            <div class="modal-header text-center">
                <span class="modal-title w-100 text-left text-dark" style="font-size:17px;">Баланс</span>
                <button type="button" class="close" style="color:#000;" data-dismiss="modal"  aria-label="Close" aria-expanded="false">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- <div class="card p-3 mb-0"> -->
                    <div class="row">
                        <div class="@if(@$general->sw_exchange == 'true') col-md-6 @else col-md-12 @endif text-center">
                            <div class="card mb-4" style="padding:.65rem 1.25rem;border-radius:.375rem;border:1px solid #e2e8f0;font-weight:510;">
                                <span style="font-size:25px;">
                                    <span id="balance_real">{{ (@Auth::user()->balance_real) ? Auth::user()->balance_real : '0' }}</span>
                                    <i class="fa fa-ruble-sign" data-toggle="tooltip" data-placement="left" title="Реальная валюта"></i>
                                </span>
                            </div>
                            <button type="button" class="btn btn-sm w-100 mb-1 balance_payment_btn" style="font-weight:500;border:1px solid #e2e8f0;color:#4a5568;">
                                Пополнить баланс
                            </button>
                        </div>
                        @if(@$general->sw_exchange == 'true')
                        <div class="col-md-6 text-center">
                            <div class="card mb-4" style="padding:.65rem 1.25rem;border-radius:.375rem;border:1px solid #e2e8f0;font-weight:510;">
                                <span style="font-size:25px;">
                                    <span id="balance_game">0</span>
                                    <i class="fa fa-coins" data-toggle="tooltip" data-placement="left" title="Игровая валюта"></i>
                                </span>
                            </div>
                            <select class="form-control form-control-sm select-max-width mb-1" style="border-radius:.375rem;" id="balance_server_id" name="balance_server_id">
                                <option value="" selected disabled>Выберите сервер</option>
                                @foreach($servers as $server)
                                <option value="{{ @$server->id }}" data-server-id="{{ @$server->id }}" data-server-name="{{ @$server->name }}">Сервер {{ @$server->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    </div>
                <!-- </div> -->
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12 p-0">
                        <div class="mt-1" id="balance_refill_real" style="display:none;">
                            <form id="form_pays" action="#" method="POST" class="p-0 m-0">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="md-form mb-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                  <div class="input-group-text input-group-sm">
                                                      <i class="fa fa-ruble-sign"></i>
                                                  </div>
                                                </div>
                                                <input type="number" id="sum_pays_rubs" name="sum_pays_rubs" class="form-control form-control-sm validate" placeholder="Сумма {{ @$general->currency_symbol }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-sm btn-primary w-100 balance_refill_go">Оплатить</button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="alert alert-group alert-primary alert-dismissible fade show alert-icon mt-2 mb-0" role="alert">
                                            <div class="alert-group-prepend">
                                                <span class="alert-group-icon text-">
                                                    <i class="fa fa-info-circle"></i>
                                                </span>
                                            </div>
                                            <div class="alert-content">
                                                <strong>
                                                    Вы получите
                                                    <strong id="sum_rubs_x" style="font-weight:700;">0</strong>
                                                    {{ @$general->currency_symbol }} после оплаты платежа.
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="mt-1" id="balance_refill_game" style="display:none;">
                            <h5 class="text-center">Обмен валюты</h5>
                            <form id="form_exch" action="#" method="POST" class="p-0 m-0">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="md-form mb-2">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                  <div class="input-group-text input-group-sm">
                                                      <i class="fa fa-ruble-sign"></i>
                                                  </div>
                                                </div>
                                                <input type="number" id="sum_pays_coin" name="sum_pays_coin" class="form-control form-control-sm validate" placeholder="Отдаём {{ @$general->currency_symbol }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-sm btn-primary w-100 balance_exchange_btn">Обменять</button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="alert alert-group alert-primary alert-dismissible fade show alert-icon mt-2 mb-0" role="alert">
                                            <div class="alert-group-prepend">
                                                <span class="alert-group-icon text-">
                                                    <i class="fa fa-info-circle"></i>
                                                </span>
                                            </div>
                                            <div class="alert-content">
                                                <strong>
                                                    <!-- [<strong id="sum_serv_x" style="font-weight:700;">#</strong>] -->
                                                    Вы получите
                                                    <strong id="sum_coin_x" style="font-weight:700;">0</strong>
                                                    {{ @$general->game_symbol }} за
                                                    <strong id="sum_pays_x" style="font-weight:700;">0</strong>
                                                    {{ @$general->currency_symbol }}
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal mt-5" id="modal_item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content m-auto" style="margin-top:25px !important;">
            <div class="modal-header text-center">
                <span id="modal_item_name" class="modal-title w-100 text-left text-dark" style="font-size:17px;"></span>
                <button type="button" class="close" style="color:#000;" data-dismiss="modal"  aria-label="Close" aria-expanded="false">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <img id="modal_item_image" src="" width="128" height="128">
                    </div>
                    <div class="col-md-8 pl-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-expand w-100">
                                <tbody>
                                    <tr class="wow pulse" data-wow-delay="0.3s">
                                        <td class="text-left">
                                            <span>
                                                Сервер
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <span id="modal_item_server_name" style="font-weight:700;">
                                                #
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="wow pulse" data-wow-delay="0.3s">
                                        <td class="text-left">
                                            <span>
                                                Стоимость
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <span>
                                                <span id="modal_item_price" style="font-weight:700;">#</span> {{ @$general->currency_symbol }}
                                                за
                                                <span id="modal_item_count" style="font-weight:700;">#</span> шт.
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row col-md-12 p-0 m-0">
                            {{-- Система промокодов --}}
                            <div class="col-md-12 p-0 mb-3">
                                <label for="item_promo">
                                    <b style="font-size: 16px;">Промокод</b>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="item_promo" name="promo" class="form-control" placeholder="Введите код">    
                                </div>
                                <small id="item_promo_label">Введите промокод</small>
                            </div>
                            {{-- /Система промокодов --}}
                            <div class="col-md-6 p-0">
                                <div class="md-form">
                                    <div class="input-group input-group-sm">
                                        <input type="number" id="item_buys_amount" name="item_buys_amount" class="form-control form-control-sm validate" placeholder="Кол-во">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <button type="button" id="modal_item_buys" onclick="modal_item_buys(this);" class="btn btn-sm btn-primary w-100"
                                    data-item-id="" data-promo-id="" data-promo-value=""
                                >
                                    Приобрести
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="item_buys_alert" class="alert alert-group alert-primary alert-dismissible fade show alert-icon mb-0" role="alert" style="display:none;">
                    <div class="alert-group-prepend">
                        <span class="alert-group-icon text-">
                            <i id="item_buys_alert_icon" class="fa fa-info-circle"></i>
                        </span>
                    </div>
                    <div class="alert-content">
                        <strong id="item_buys_alert_text">
                            Вы получите
                            <span id="item_buys_alert_endcount" style="font-weight:700;">#</span>
                            шт. за
                            <span id="item_buys_alert_endprice" style="font-weight:700;">#</span>
                            {{ @$general->currency_symbol }}
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal mt-5" id="modal_kit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content m-auto" style="margin-top:25px !important;">
            <div class="modal-header text-center">
                <span id="modal_kit_name" class="modal-title w-100 text-left text-dark" style="font-size:17px;"></span>
                <button type="button" class="close" style="color:#000;" data-dismiss="modal"  aria-label="Close" aria-expanded="false">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <img id="modal_kit_image" src="" width="128" height="128">
                    </div>
                    <div class="col-md-8 pl-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-expand w-100">
                                <tbody>
                                    <tr class="wow pulse" data-wow-delay="0.3s">
                                        <td class="text-left">
                                            <span>
                                                Сервер
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <span id="modal_kit_server_name" style="font-weight:700;">
                                                #
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="wow pulse" data-wow-delay="0.3s">
                                        <td class="text-left">
                                            <span>
                                                Стоимость
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <span>
                                                <span id="modal_kit_price" style="font-weight:700;">#</span> {{ @$general->currency_symbol }}
                                                за
                                                <span id="modal_kit_count" style="font-weight:700;">#</span> шт.
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row col-md-12 p-0 m-0">
                            {{-- Система промокодов --}}
                            <div class="col-md-12 p-0 mb-3">
                                <label for="kit_promo">
                                    <b style="font-size: 16px;">Промокод</b>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="kit_promo" name="promo" class="form-control" placeholder="Введите код">    
                                </div>
                                <small id="kit_promo_label">Введите промокод</small>
                            </div>
                            {{-- /Система промокодов --}}
                            <div class="col-md-6 p-0">
                                <div class="md-form">
                                    <div class="input-group input-group-sm">
                                        <input type="number" id="kit_buys_amount" name="kit_buys_amount" class="form-control form-control-sm validate" placeholder="Кол-во">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                                <button type="button" id="modal_kit_buys" onclick="modal_kit_buys(this);" class="btn btn-sm btn-primary w-100"
                                    data-kit-id="" data-promo-id="" data-promo-value=""
                                >
                                    Приобрести
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="kit_buys_alert" class="alert alert-group alert-primary alert-dismissible fade show alert-icon mb-0" role="alert" style="display:none;">
                    <div class="alert-group-prepend">
                        <span class="alert-group-icon text-">
                            <i id="kit_buys_alert_icon" class="fa fa-info-circle"></i>
                        </span>
                    </div>
                    <div class="alert-content">
                        <strong id="kit_buys_alert_text">
                            Вы получите
                            <span id="kit_buys_alert_endcount" style="font-weight:700;">#</span>
                            шт. за
                            <span id="kit_buys_alert_endprice" style="font-weight:700;">#</span>
                            {{ @$general->currency_symbol }}
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal mt-5" id="modal_privilege" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content m-auto" style="margin-top:25px !important;">
            <div class="modal-header text-center">
                <span id="modal_privilege_name" class="modal-title w-100 text-left text-dark" style="font-size:17px;"></span>
                <button type="button" class="close" style="color:#000;" data-dismiss="modal"  aria-label="Close" aria-expanded="false">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <img id="modal_privilege_image" src="" width="128" height="128" style="width:100%;height:auto;">
                    </div>
                    <div class="col-md-8 pl-0">
                        <div class="table-responsive mb-0">
                            <table class="table table-sm table-expand w-100 mb-0">
                                <tbody>
                                    <tr class="wow pulse" data-wow-delay="0.3s">
                                        <td class="text-left">
                                            <span>
                                                Сервер
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <span id="modal_privilege_server_name" style="font-weight:700;">
                                                #
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="wow pulse" data-wow-delay="0.3s">
                                        <td class="text-left">
                                            <span>
                                                Стоимость
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <span>
                                                <span id="modal_privilege_price" style="font-weight:700;">#</span> <span id="modal_privilege_price_symbol">{{ @$general->currency_symbol }}</span>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive mb-1" style="overflow-y:scroll;max-height:172px;">
                            <table class="table table-sm table-expand w-100 mb-0">
                                <tbody>
                                    @if(@$general->sw_prefixes == 'true')
                                    <tr class="wow pulse" data-wow-delay="0.3s">
                                        <td class="text-left">
                                            <span>
                                                Установка префикса
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <span id="modal_privilege_prefix" style="font-weight:700;">#</span>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr class="wow pulse" data-wow-delay="0.3s">
                                        <td class="text-left">
                                            <span>
                                                Установка скинов
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <span id="modal_privilege_skin" style="font-weight:700;">#</span>
                                        </td>
                                    </tr>
                                    <tr class="wow pulse" data-wow-delay="0.3s">
                                        <td class="text-left">
                                            <span>
                                                Установка скинов HD
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <span id="modal_privilege_skin_hd" style="font-weight:700;">#</span>
                                        </td>
                                    </tr>
                                    <tr class="wow pulse" data-wow-delay="0.3s">
                                        <td class="text-left">
                                            <span>
                                                Установка плащей
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <span id="modal_privilege_cloak" style="font-weight:700;">#</span>
                                        </td>
                                    </tr>
                                    <tr class="wow pulse" data-wow-delay="0.3s">
                                        <td class="text-left">
                                            <span>
                                                Установка плащей HD
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <span id="modal_privilege_cloak_hd" style="font-weight:700;">#</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row col-md-12 p-0 m-0">
                            <!-- <div class="col-md-6 p-0">
                                <div class="md-form">
                                    <div class="input-group input-group-sm">
                                        <input type="number" id="privilege_buys_amount" name="privilege_buys_amount" class="form-control form-control-sm validate" placeholder="Кол-во">
                                    </div>
                                </div>
                            </div> -->
                            
                            {{-- Система промокодов --}}
                            <div class="col-md-12 p-0 mb-3">
                                <label for="promo">
                                    <b style="font-size: 16px;">Промокод</b>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="promo" name="promo" class="form-control" placeholder="Введите код">    
                                </div>
                                <small id="promo_label">Введите промокод</small>
                            </div>
                            {{-- /Система промокодов --}}

                            <div class="col-md-12 p-0">
                                <button type="button" id="modal_privilege_buys" onclick="modal_privilege_buys(this);" class="btn btn-sm btn-primary w-100"
                                    data-privilege-id="" data-promo-id=""
                                >
                                    Приобрести
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="privilege_buys_alert" class="alert alert-group alert-primary alert-dismissible fade show alert-icon mb-0" role="alert" style="display:none;">
                    <div class="alert-group-prepend">
                        <span class="alert-group-icon text-">
                            <i id="privilege_buys_alert_icon" class="fa fa-info-circle"></i>
                        </span>
                    </div>
                    <div class="alert-content">
                        <strong id="privilege_buys_alert_text"></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    // ACTION BALANCE
    function alert_pays() {
        if($('#sum_pays_rubs').val() == '') {
            $('#sum_pays_rubs').val('');
            $('#sum_rubs_x').html('0');
        } else if($('#sum_pays_rubs').val() < 1) {
            $('#sum_pays_rubs').val('');
        } else if($('#sum_pays_rubs').val() > 10000) {
            $('#sum_pays_rubs').val('10000');
        }
        var sum_pays_rubs = (!$('#sum_pays_rubs').val()) ? 0 : $('#sum_pays_rubs').val();
        $('#sum_rubs_x').html(sum_pays_rubs);
    }
    $(document).on('change', '#sum_pays_rubs', function () {
        alert_pays();
    });
    $(document).on('keyup', '#sum_pays_rubs', function () {
        alert_pays();
    });

    function alert_exch() {
        if($('#sum_pays_coin').val() == '') {
            $('#sum_pays_coin').val('');
            $('#sum_pays_x').html('0');
        } else if($('#sum_pays_coin').val() < 1) {
            $('#sum_pays_coin').val('');
        } else if($('#sum_pays_coin').val() > 10000) {
            $('#sum_pays_coin').val('10000');
        }
        var sum_pays_coin = (!$('#sum_pays_coin').val()) ? 0 : $('#sum_pays_coin').val();
        var exch_rubs_to_coin = '{{ @$general->exch_rubs_to_coin }}';
        var multiply = sum_pays_coin * exch_rubs_to_coin;
        $('#sum_coin_x').html((!multiply) ? 0 : multiply);
        $('#sum_pays_x').html(sum_pays_coin);
    }
    $(document).on('change', '#sum_pays_coin', function () {
        alert_exch();
    });
    $(document).on('keyup', '#sum_pays_coin', function () {
        alert_exch();
    });

    $(document).on('change', '#balance_server_id', function () {
        if($('#sum_pays_coin').val()) {
            $('#sum_pays_coin').val('');
            $('#sum_coin_x').html('0');
            $('#sum_pays_x').html('0');
        }
        $('.balance_payment_btn').css('border', '1px solid #e2e8f0');
        $(this).css('border', '1px solid #008aff');
        balance_get($(this).val());
        var server_name = $("#balance_server_id option:selected").data('server-name');
        $('#sum_serv_x').html(server_name);
        $('#balance_refill_real').slideUp(250);
        $('#balance_refill_game').slideDown(250);
    });
    $(document).on('click', '.balance_payment_btn', function () {
        if($('#sum_pays_rubs').val()) {
            $('#sum_pays_rubs').val('');
            $('#sum_rubs_x').html('0');
        }
        $('#balance_server_id').css('border', '1px solid #e2e8f0');
        $(this).css('border', '1px solid #008aff');
        balance_get(0);
        $('#balance_server_id').val('');
        $("#balance_game").html('0');
        $('#balance_refill_game').slideUp(250);
        $('#balance_refill_real').slideDown(250);
    });
    $(document).on('click', '.balance_refill_go', function () {
        var sum_pays_rubs = $('#sum_pays_rubs').val();
        if(!sum_pays_rubs) {
            notify('Вы не ввели сумму пополнения', 8000, 'warning');
            return false;
        }
        $(this).attr('disabled', true);
        $.ajax({
            type: 'POST',
            url: '{{ route('balance.payment') }}',
            data: {
                _token: csrf_token,
                sum_pays_rubs: sum_pays_rubs
            },
            success: function(data) {
                $('.balance_refill_go').attr('disabled', false);
                notify(data.message, 8000, data.type);
                if(data.type == "info") {
                    balance_get(0);
                    if(data.link) {
                        document.location.href = data.link;
                    }
                }
            },
            error: function(data) {
                console.log(data);
                $('.balance_refill_go').attr('disabled', false);
            }
        });
    });
    $(document).on('click', '.balance_exchange_btn', function () {
        var sum_pays_coin = $('#sum_pays_coin').val();
        var balance_server_id = $("#balance_server_id option:selected").data('server-id');
        if(!balance_server_id) {
            notify('Вы не выбрали сервер из списка', 8000, 'warning');
            return false;
        }
        if(!sum_pays_coin) {
            notify('Вы не ввели сумму обмена в поле ввода', 8000, 'warning');
            return false;
        }
        $(this).attr('disabled', true);
        $.ajax({
            type: 'POST',
            url: '{{ route('balance.exchange') }}',
            data: {
                _token: csrf_token,
                sum_pays_coin: sum_pays_coin,
                balance_server_id: balance_server_id
            },
            success: function(data) {
                $('.balance_exchange_btn').attr('disabled', false);
                notify(data.message, 8000, data.type);
                if(data.type == "info") {
                    balance_get(balance_server_id);
                }
            },
            error: function(data) {
                console.log(data);
                $('.balance_exchange_btn').attr('disabled', false);
            }
        });
    });
</script>
@endif