@extends('frontend.layouts.master-alternate')
@section('page_title', 'Возможности привилегий')
@section('body')

<!-- VIP -->
<div class="card bg-gradient-success border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h4 text-white mb-0">VIP</span>
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
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">/kit vip</h5>
<img src="/assets/img/donate/kits/technomagic/vip.png" alt="">     
            </div>
        </div>
    </div>
</div>

<!-- /VIP -->

<!-- Premium -->
<div class="card bg-gradient-danger border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h4 text-white mb-0">Premium</span>
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
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">/kit premium</h5>
<img src="/assets/img/donate/kits/technomagic/premium.png" alt="">     
            </div>
        </div>
    </div>
</div>
<!-- /Premium -->

<!-- Diamond -->
<div class="card bg-gradient-info border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h4 text-white mb-0">Diamond</span>
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
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">/kit diamond</h5>
<img src="/assets/img/donate/kits/technomagic/diamond.png" alt="">     
            </div>
        </div>
    </div>
</div>
<!-- /Diamond -->

<!-- Sapphire -->
<div class="card bg-gradient-dark border-0 rounded-lg" style="max-width: 100%;">
    <div class="card-body px-5">
        <div class="align-items-center">
            <span class="h4 text-white mb-0">Sapphire</span>
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
            <div class="col-md-6">
                <h5 class="text-white h6 mt-4 mb-1">/kit sapphire</h5>
<img src="/assets/img/donate/kits/technomagic/sapphire.png" alt="">     
            </div>
        </div>
    </div>
</div>
<!-- /Sapphire -->
@endsection