@extends('frontend.layouts.master-alternate')
@section('page_title', 'Платные услуги')
@section('body')
<style>
    .case {
        display: block;
        border-radius: 5px;
        background: #f6f9fc;
        padding: 25px;
        height: 100%;
        overflow: hidden;
        text-decoration: none;
    }
    .case > p {
        color: rgba(0, 0, 0, 0.5);
        font-weight: 400;
    }
    a.active {
        background: #008aff;
    }
    a.active > span > h5 {
        color: white
    }
    a.active > p {
        color: rgba(255, 255, 255, 0.7)
    }
    .kitblock {
        transition: all 0.3s ease;
    }
    .kitblock:hover {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 5px;
        transition: all 0.3s ease;
    }
    .kitimage {
        display: none;
    }
    .kitblock:hover ~ .kitimage {
        display: block;
    }
</style>

<p>Хотите прокачать возможности своего аккаунта? Получить максимум удовольствия от любимой игры? Для Вас мы готовые предложить нечто особенное! Выберите свой сервер, кликнув ниже по нужному варианту.</p>
<ul class="nav mb-2">
    <li class="nav-item col-12 col-md-6 col-sm-6 col-xs-6 p-0 pr-2 mt-2">
      <a class="nav-link active case" data-toggle="tab" href="#nav-hitech" role="tab" aria-controls="nav-hitech" aria-selected="true">
          <span><h5>HiTech</h5></span>  
            <p>Уникальный Minecraft сервер, который заполнен техникой и автоматизацией. </p>
      </a>
    </li>
    {{-- <li class="nav-item col-12 col-md-6 col-sm-6 col-xs-6 p-0 pr-2 mt-2">
      <a class="nav-link case" data-toggle="tab" href="#nav-anarchy" role="tab" aria-controls="nav-anarchy" aria-selected="true">
        <span><h5>Anarchy</h5></span>  
        <p>Это сервер где нет правил. Играй на Анархии так, как тебе вздумается.</p>
      </a>
    </li> --}}
  </ul>

<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
 <div class="tab-pane fade show active" id="nav-hitech" role="tabpanel" aria-labelledby="nav-hitech-tab">
<!-- VIP -->
<div class="card bg-gradient-success border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">VIP</span>
        </div>

        <div class="row">
            <div class="col-md-3">
                <h5 class="text-white h6 mt-4 mb-1">4 точки дома</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /sethome
                </p>
                <h5 class="text-white h6 mt-4 mb-1">3 привата</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg claim
                </p>
                <h5 class="text-white h6 mt-4 mb-1">4 чанка</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Максимальный размер региона
                </p>
            </div>
            <div class="col-md-3">
                <h5 class="text-white h6 mt-4 mb-1">Установка 1 варпа</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /warp
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard в приватах</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    pvp, use, leaf-decay (/rg flag флаг)
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Загрузка HD скинов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Выделись на сервере с крутым скином
                </p>        
            </div>
            <div class="col-md-3">
                <h5 class="text-white h6 mt-4 mb-1">Загрузка плаща</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Выделись на сервере с крутым плащом
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Виртуальный верстак</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /craft
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Покормить себя</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /feed
                </p>   
            </div>
            <div class="col-md-3">
                <h5 class="text-white h6 mt-4 mb-1">Виртуальный эндерсундук</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /enderchest
                </p>     
            </div>
            <hr class="divider divider-fade" />
            <h5 class="text-uppercase">Наведите для просмотра набора:</h5>
            <div class="col-md-6 mb-2 kitblock pb-4">
                <h5 class="text-white h6 mt-4 mb-1">Пакет ресурсов VIP</h5>
                <small class="text-white opacity-5">Наведите, чтобы посмотреть содержимое набора. Для получения в игре введите <b>/kit vip</b></small>
            </div>
            <div class="col-12 kitimage pl-0">
                <img src="/assets/img/donate/kits/hitech/vip.png" style="width: 100%" alt="">     
            </div>
        </div>
    </div>
</div>

<!-- /VIP -->

<!-- Premium -->
<div class="card bg-gradient-danger border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h4 text-white mb-0" style="text-shadow: white 0 0 0.5em;">Premium</span>
        </div>

        <div class="row">
            <div class="col-md-3">
                <h5 class="text-white h6 mt-4 mb-1">6 точек дома</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /sethome
                </p>
                <h5 class="text-white h6 mt-4 mb-1">5 приватов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg claim
                </p>
                <h5 class="text-white h6 mt-4 mb-1">4 чанка</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Максимальный размер региона
                </p>
                <h5 class="text-white h6 mt-4 mb-1">Установка 2 варпов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /warp
                </p>  
            </div>
            <div class="col-md-3">

                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard в приватах</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    pvp, use, leaf-decay, chess-access, interact, snow-fall, ice-melt, creeper-explosion, greeting, farewell, enderpearl (/rg flag флаг)
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Загрузка HD скинов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Выделись на сервере с крутым скином
                </p>        
            </div>
            <div class="col-md-3">
                <h5 class="text-white h6 mt-4 mb-1">Загрузка HD плаща</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Выделись на сервере с крутым плащом
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Виртуальный верстак</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /craft
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Покормить себя</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /feed
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Виртуальный эндерсундук</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /enderchest
                </p>   
            </div>
            <div class="col-md-3">
                <h5 class="text-white h6 mt-4 mb-1">Режим полета</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /fly
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Вылечить себя</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /heal
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Надеть блок на голову</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /hat
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Возможность управления временем</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /ptime
                </p> 
            </div>
            <hr class="divider divider-fade" />
            <h5 class="text-uppercase">Наведите для просмотра набора:</h5>
            <div class="col-md-6 mb-2 kitblock pb-4">
                <h5 class="text-white h6 mt-4 mb-1">Пакет ресурсов Premium</h5>
                <small class="text-white opacity-5">Наведите, чтобы посмотреть содержимое набора. Для получения в игре введите <b>/kit premium</b></small>
            </div>
            <div class="col-12 kitimage pl-0">
                <img src="/assets/img/donate/kits/hitech/premium.png" style="width: 100%" alt="">     
            </div>
        </div>
    </div>
</div>
<!-- /Premium -->

<!-- Diamond -->
<div class="card bg-gradient-info border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h4 text-white mb-0" style="text-shadow: white 0 0 0.5em;">Diamond</span>
        </div>

        <div class="row">
            <div class="col-md-3">
                <h5 class="text-white h6 mt-4 mb-1">8 точек дома</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /sethome
                </p>
                <h5 class="text-white h6 mt-4 mb-1">7 приватов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg claim
                </p>
                <h5 class="text-white h6 mt-4 mb-1">4 чанка</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Максимальный размер региона
                </p>
                <h5 class="text-white h6 mt-4 mb-1">Установка 3 варпов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /warp
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard в приватах</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    pvp, use, leaf-decay, chess-access, interact, snow-fall, 
                    ice-melt, creeper-explosion, greeting, 
                    farewell, enderpearl (/rg flag флаг),
                    entry, mob-spawning, item-drop, mob-damage
                </p> 
            </div>
            <div class="col-md-3">
                <h5 class="text-white h6 mt-4 mb-1">Загрузка HD скинов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Выделись на сервере с крутым скином
                </p>      
                <h5 class="text-white h6 mt-4 mb-1">Загрузка HD плаща</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Выделись на сервере с крутым плащом
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Сохранение инвентаря при смерти</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Инвентарь не дропнется, если умрешь
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Виртуальный верстак</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /craft
                </p>     
            </div>
            <div class="col-md-3">

                <h5 class="text-white h6 mt-4 mb-1">Покормить себя</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /feed
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Виртуальный эндерсундук</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /enderchest
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Режим полета</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /fly
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Вылечить себя</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /heal
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Надеть блок на голову</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /hat
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Возможность задавать уровни вложенности регионов </h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg setparent
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Возможность задавать приоритет регионов </h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg setpriority
                </p> 
            </div>
            <div class="col-md-3">
                <h5 class="text-white h6 mt-4 mb-1">Режим ночного видения</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /nv
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Возможность управления временем</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /ptime
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Режим Бога</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /god
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Вернуться назад</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /back
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">ТП по координатам</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /tppos
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Ремонт брони и зачарованных вещей</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /repair
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Вылечить других</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /heal ник
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Прыгнуть на точку</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /jump
                </p> 
            </div>
            <hr class="divider divider-fade" />
            <h5 class="text-uppercase">Наведите для просмотра набора:</h5>
            <div class="col-md-6 mb-2 kitblock pb-4">
                <h5 class="text-white h6 mt-4 mb-1">Пакет ресурсов Diamond</h5>
                <small class="text-white opacity-5">Наведите, чтобы посмотреть содержимое набора. Для получения в игре введите <b>/kit diamond</b></small>
            </div>
            <div class="col-12 kitimage pl-0">
                <img src="/assets/img/donate/kits/hitech/diamond.png" style="width: 100%" alt="">     
            </div>
        </div>
    </div>
</div>
<!-- /Diamond -->

<!-- Sapphire -->
<div class="card bg-gradient-dark border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h4 text-white mb-0" style="text-shadow: white 0 0 0.5em;">Sapphire</span>
        </div>

        <div class="row">
            <div class="col-md-3">
                <h5 class="text-white h6 mt-4 mb-1">15 точек дома</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /sethome
                </p>
                <h5 class="text-white h6 mt-4 mb-1">15 приватов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg claim
                </p>
                <h5 class="text-white h6 mt-4 mb-1">4 чанка</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Максимальный размер региона
                </p>
                <h5 class="text-white h6 mt-4 mb-1">Установка 6 варпов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /warp
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard в приватах</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    pvp, use, leaf-decay, chess-access, interact, snow-fall, 
                    ice-melt, creeper-explosion, greeting, 
                    farewell, enderpearl (/rg flag флаг),
                    entry, mob-spawning, item-drop, mob-damage, time-lock,
                    weather-lock, item-pickup
                </p> 
            </div>
            <div class="col-md-3">
                <h5 class="text-white h6 mt-4 mb-1">Загрузка HD скинов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Выделись на сервере с крутым скином
                </p>      
                <h5 class="text-white h6 mt-4 mb-1">Загрузка HD плаща</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Выделись на сервере с крутым плащом
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Установка префикса</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Префикс и цветной ник устанавливаются в ЛК
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Сохранение инвентаря при смерти</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Инвентарь не дропнется, если умрешь
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Виртуальный верстак</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /craft
                </p>     
            </div>
            <div class="col-md-3">

                <h5 class="text-white h6 mt-4 mb-1">Покормить себя</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /feed
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Виртуальный эндерсундук</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /enderchest
                </p>   
                <h5 class="text-white h6 mt-4 mb-1">Режим полета</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /fly
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Вылечить себя</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /heal
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Надеть блок на голову</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /hat
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Возможность задавать уровни вложенности регионов </h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg setparent
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Возможность задавать приоритет регионов </h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg setpriority
                </p> 
            </div>
            <div class="col-md-3">
                <h5 class="text-white h6 mt-4 mb-1">Возможность управления временем</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /ptime
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Режим Бога</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /god
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Вернуться назад</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /back
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">ТП по координатам</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /tppos
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Ремонт брони и зачарованных вещей</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /repair
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Вылечить других</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /heal ник
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Прыгнуть на точку</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /jump
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Возможность отключать дождь</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /weather
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Выдать себе опыт</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /exp 
                </p> 
            </div>
            <hr class="divider divider-fade" />
            <h5 class="text-uppercase text-white">Наведите для просмотра набора:</h5>
            <div class="col-md-6 mb-2 kitblock pb-4">
                <h5 class="text-white h6 mt-4 mb-1">Пакет ресурсов Sapphire</h5>
                <small class="text-white opacity-5">Наведите, чтобы посмотреть содержимое набора. Для получения в игре введите <b>/kit sapphire</b></small>
            </div>
            <div class="col-12 kitimage pl-0">
                <img src="/assets/img/donate/kits/hitech/sapphire.png" style="width: 100%" alt="">     
            </div>
        </div>
        
    </div>
    
</div>
<!-- /Sapphire -->
<div class="col-12 text-center">
    <a href="{{ route('cabinet') }}" class="btn btn-primary btn-xl text-uppercase">Прокачать свой аккаунт!</a>
</div>

 </div>
 <div class="tab-pane fade" id="nav-anarchy" role="tabpanel" aria-labelledby="nav-anarchy-tab">
<!-- Воин -->
<div class="card bg-gradient-success border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">Воин</span>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">4 слота на аукционе</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Торгуй на аукционе и становись богаче
                </p>
                <h5 class="text-white h6 mt-4 mb-1">6 приватов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg claim
                </p>
            </div>
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">Возможность открыть верстак</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /workbench
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Возможность узнать свои координаты</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /getpos
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Возможность отключить личку</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /msgtoggle
                </p>        
            </div>
        </div>
    </div>
</div>
<!-- /Воин -->
<!-- Титан -->
<div class="card bg-gradient-danger border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">Титан</span>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">7 слотов на аукционе</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Торгуй на аукционе и становись богаче
                </p>
                <h5 class="text-white h6 mt-4 mb-1">7 приватов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg claim
                </p>
                <h5 class="text-white h6 mt-4 mb-1">5 точек дома</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /sethome
                </p>
            </div>
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">Возможность надеть блок</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /hat
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Возможность сменить себе погоду</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /pweather
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Стрельнуть котиком</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /kittycannon
                </p>        
                <h5 class="text-white h6 mt-4 mb-1">Стрельнуть пчелкой</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /beezoka
                </p>      
            </div>
        </div>
    </div>
</div>
<!-- /Титан -->
<!-- Странник -->
<div class="card bg-gradient-info border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">Странник</span>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">8 слотов на аукционе</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Торгуй на аукционе и становись богаче
                </p>
                <h5 class="text-white h6 mt-4 mb-1">8 приватов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg claim
                </p>
                <h5 class="text-white h6 mt-4 mb-1">10 точек дома</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /sethome
                </p>
                <h5 class="text-white h6 mt-4 mb-1">VIP слот</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Можно зайти на полный сервер
                </p>  
            </div>
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">Возможность писать в админ-чат</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /ac
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Возможность игнорировать игрока</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /ignore
                </p>        
                <h5 class="text-white h6 mt-4 mb-1">Возможность очистить инвентарь</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /clear
                </p>
                <h5 class="text-white h6 mt-4 mb-1">Возможность смотреть инфо о сервере</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /gc
                </p>       
            </div>
        </div>
    </div>
</div>
<!-- /Странник -->
<!-- Каратель -->
<div class="card bg-gradient-dark border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">Каратель</span>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">12 слотов на аукционе</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Торгуй на аукционе и становись богаче
                </p>
                <h5 class="text-white h6 mt-4 mb-1">9 приватов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg claim
                </p>
                <h5 class="text-white h6 mt-4 mb-1">15 точек дома</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /sethome
                </p>
                <h5 class="text-white h6 mt-4 mb-1">VIP слот</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Можно зайти на полный сервер
                </p> 
            </div>
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">Возможность включить свечение </h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /glow
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Возможность отключить тп</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /tptoggle
                </p>        
            </div>
        </div>
    </div>
</div>
<!-- /Каратель -->
<!-- Легенда -->
<div class="card bg-gradient-success border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">Легенда</span>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h5 class="text-white h6 mt-4 mb-1">22 слота на аукционе</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Торгуй на аукционе и становись богаче
                </p>
                <h5 class="text-white h6 mt-4 mb-1">10 приватов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg claim
                </p>
                <h5 class="text-white h6 mt-4 mb-1">20 точек дома</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /sethome
                </p>
                <h5 class="text-white h6 mt-4 mb-1">VIP слот</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Можно зайти на полный сервер
                </p> 
            </div>
            <div class="col-md-4">
                <h5 class="text-white h6 mt-4 mb-1">Возможность починить предмет</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /repair
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Возможность кикнуть игрока</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /kick
                </p>     
                <h5 class="text-white h6 mt-4 mb-1">Возможность накормить игрока</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /feed
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Возможность сменить ник</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /nick
                </p>    
            </div>
            <div class="col-md-4">
                <h5 class="text-white h6 mt-4 mb-1">Возможность сменить погоду сервера</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /weather
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Возможность сменить время сервера</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /time set
                </p>     
                <h5 class="text-white h6 mt-4 mb-1">Возможность узнать реальное имя</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /realname
                </p>     
            </div>
        </div>
    </div>
</div>
<!-- /Легенда -->
<!-- Мастер -->
<div class="card bg-gradient-danger border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">Мастер</span>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h5 class="text-white h6 mt-4 mb-1">30 слотов на аукционе</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Торгуй на аукционе и становись богаче
                </p>
                <h5 class="text-white h6 mt-4 mb-1">12 приватов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg claim
                </p>
                <h5 class="text-white h6 mt-4 mb-1">25 точек дома</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /sethome
                </p>
                <h5 class="text-white h6 mt-4 mb-1">VIP слот</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Можно зайти на полный сервер
                </p> 
            </div>
            <div class="col-md-4">
                <h5 class="text-white h6 mt-4 mb-1">Возможность забанить игрока</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /tempban
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Возможность дать мут игроку</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /tempmute
                </p>     
                <h5 class="text-white h6 mt-4 mb-1">Возможность снять мут</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /unmute
                </p> 
                <h5 class="text-white h6 mt-4 mb-1">Возможность открыть эндерсундук</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /enderchest
                </p>    
                <h5 class="text-white h6 mt-4 mb-1">Доступ к цветному чату</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    & + цифра цвета
                </p>    
            </div>
            <div class="col-md-4">
                <h5 class="text-white h6 mt-4 mb-1">Возможность потушить себя</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /ext
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Возможность читать чужую личку</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /socialspy
                </p>     
                <h5 class="text-white h6 mt-4 mb-1">Возможность вылечить себя</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /heal
                </p>     
                <h5 class="text-white h6 mt-4 mb-1">Возможность создавать варп</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /setwarp
                </p>  
            </div>
        </div>
    </div>
</div>
<!-- /Мастер -->
<!-- Иммортал -->
<div class="card bg-gradient-info border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">Иммортал</span>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h5 class="text-white h6 mt-4 mb-1">40 слотов на аукционе</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Торгуй на аукционе и становись богаче
                </p>
                <h5 class="text-white h6 mt-4 mb-1">15 приватов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg claim
                </p>
                <h5 class="text-white h6 mt-4 mb-1">40 точек дома</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /sethome
                </p>
                <h5 class="text-white h6 mt-4 mb-1">VIP слот</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Можно зайти на полный сервер
                </p> 
            </div>
            <div class="col-md-4">
                <h5 class="text-white h6 mt-4 mb-1">Возможность выдать донат</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /grant
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Возможность открыть чужой инвентарь</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /invsee
                </p>    
                <h5 class="text-white h6 mt-4 mb-1">Нет кика за АФК</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Можно стоять на месте сколько угодно
                </p>    
                <h5 class="text-white h6 mt-4 mb-1">Возможность отправить запрос тп</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /tpahere
                </p>   
            </div>
            <div class="col-md-4">
                <h5 class="text-white h6 mt-4 mb-1">Сменить префикс в табе</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /prefix
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Сменить префикс в чате</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /prefix
                </p>      
            </div>
        </div>
    </div>
</div>
<!-- /Иммортал -->
<!-- Энигма -->
<div class="card bg-gradient-dark border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">Энигма</span>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">60 слотов на аукционе</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Торгуй на аукционе и становись богаче
                </p>
                <h5 class="text-white h6 mt-4 mb-1">20 приватов</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /rg claim
                </p>
                <h5 class="text-white h6 mt-4 mb-1">50 точек дома</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /sethome
                </p>
                <h5 class="text-white h6 mt-4 mb-1">VIP слот</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    Можно зайти на полный сервер
                </p> 
            </div>
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">Возможность выдать донат</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /grant
                </p>  
                <h5 class="text-white h6 mt-4 mb-1">Возможность забанить игрока навсегда</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /ban
                </p>    
                <h5 class="text-white h6 mt-4 mb-1">Возможность получить голову игрока</h5>
                <p class="text-sm text-white opacity-5 mb-0">
                    /skull
                </p>    
            </div>
        </div>
    </div>
</div>
<!-- /Энигма -->
<div class="col-12 text-center">
    <a href="{{ route('cabinet') }}" class="btn btn-primary btn-xl text-uppercase">Прокачать свой аккаунт!</a>
</div>
    </div>
</div>

@endsection