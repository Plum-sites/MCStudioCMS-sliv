@extends('frontend.layouts.master-alternate')
@section('meta_page_title', 'Название страницы с донатом для Meta')
@section('meta_page_description', 'Описание страницы с донатом для Meta')
@section('meta_page_keywords', 'донат, купить донат, сервер майнкрафт')
@section('page_title', 'Возможности привилегий')
@section('body')

<ul class="nav nav-pills nav-fill mb-2">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#nav-hitech" role="tab" aria-controls="nav-hitech" aria-selected="true">HiTech</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#nav-anarchy" role="tab" aria-controls="nav-anarchy" aria-selected="true">Anarchy</a>
    </li>
  </ul>
  <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-hitech" role="tabpanel" aria-labelledby="nav-hitech-tab">
        <table class="table table-dark ">
            <thead>
              <tr>
                <th scope="col" class="text-white" style="font-size: 16px"><i class="fab fa-codepen mr-2"></i>Основные возможности</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">VIP</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">Premium</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">Diamond</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">Sapphire</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">Titan</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">Zeus</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Количество приватов</th>
                <td class="text-center">3</td>
                <td class="text-center">5</td>
                <td class="text-center">7</td>
                <td class="text-center">8</td>
                <td class="text-center">10</td>
                <td class="text-center">15</td>
              </tr>
              <tr>
                <th scope="row">Количество точек дома</th>
                <td class="text-center">4</td>
                <td class="text-center">6</td>
                <td class="text-center">8</td>
                <td class="text-center">15</td>
                <td class="text-center">20</td>
                <td class="text-center">25</td>
              </tr>
              <tr>
                <th scope="row">Количество варпов</th>
                <td class="text-center">1</td>
                <td class="text-center">2</td>
                <td class="text-center">3</td>
                <td class="text-center">6</td>
                <td class="text-center">10</td>
                <td class="text-center">15</td>
              </tr>
              <tr>
                <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="
                    <p>user</p>
                    <p>pvp</p>
                    <p>leaf-decay</p>
                "></i>Набор флагов VIP</th>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
           </tr>
              <tr>
                <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="
                    <p>chest-access</p>
                    <p>interact</p>
                    <p>snow-fall</p>
                    <p>ice-melt</p>
                    <p>creeper-explosion</p>
                    <p>greeting</p>
                    <p>farewell</p>
                    <p>enderpearl</p>
                "></i>Набор флагов Premium</th>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
           
              </tr>
              <tr>
                <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="
                    <p>entry</p>
                    <p>mob-spawning</p>
                    <p>item-drop</p>
                    <p>mob-damage</p>
                "></i>Набор флагов Diamond</th>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
           
              </tr>
              <tr>
                <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="
                    <p>time-lock</p>
                    <p>weather-lock</p>
                    <p>item-pickup</p>
                "></i>Набор флагов Sapphire</th>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
           
              </tr>
              <tr>
                <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="" data-original-title="<ul style='margin:0px;padding:5px 5px 5px 10px;list-style:none;'><1.12.2:<br><li>farewell</li><li>ice-melt</li><li>ice-form</li><li>greeting</li><li>leaf-decay</li><li>notify-enter</li><li>notify-leave</li><br>>1.12.2:<li>block-place</li><li>block-break</li><li>interact-block-primary</li></ul>"></i>Набор флагов Titan</th>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
           
              </tr>
              <tr>
                <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="" data-original-title="<ul style='margin:0px;padding:5px 5px 5px 10px;list-style:none;'><1.12.2:<br><li>farewell</li><li>ice-melt</li><li>ice-form</li><li>greeting</li><li>leaf-decay</li><li>notify-enter</li><li>notify-leave</li><br>>1.12.2:<li>block-place</li><li>block-break</li><li>interact-block-primary</li></ul>"></i>Набор флагов Zeus</th>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
           
              </tr>
            </tbody>
            <thead>
                <tr>
                  <th scope="col" class="text-white" style="font-size: 16px"><i class="fab fa-get-pocket mr-2"></i>Дополнительные команды</th>
                  <th scope="col" class="text-white text-center" style="font-size: 16px">VIP</th>
                  <th scope="col" class="text-white text-center" style="font-size: 16px">Premium</th>
                  <th scope="col" class="text-white text-center" style="font-size: 16px">Diamond</th>
                  <th scope="col" class="text-white text-center" style="font-size: 16px">Sapphire</th>
                  <th scope="col" class="text-white text-center" style="font-size: 16px">Titan</th>
                  <th scope="col" class="text-white text-center" style="font-size: 16px">Zeus</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Восполнить голод - /feed</th>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
             </tr>
             <tr>
                <th scope="row">Открыть верстак - /workbench</th>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
           </tr>
           <tr>
            <th scope="row">Эндерсундук - /enderchest</th>
            <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
            <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
            <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
            <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
            <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
            <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
       </tr>
                <tr>
                  <th scope="row">Режим полета - /fly</th>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
             
                </tr>
                <tr>
                    <th scope="row">Восполнить здоровье - /heal</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
                  <tr>
                    <th scope="row">Надеть блок на голову - /hat</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
                  <tr>
                    <th scope="row">Изменить личное время - /ptime</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
                  <tr>
                    <th scope="row">Включить режим Бога - /god</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
                  <tr>
                    <th scope="row">Вернуться назад - /back</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
                  <tr>
                    <th scope="row">Телепорт по координатам - /tppos</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
                  <tr>
                    <th scope="row">Прыгнуть вверх - /jump</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
                  <tr>
                    <th scope="row">Вылечить других - /heal ник</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
                  <tr>
                    <th scope="row">Починить инструмент или броню <br>(+ зачар) - /repair</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
                  <tr>
                    <th scope="row">Сохранение инвентаря после смерти</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
                  <tr>
                    <th scope="row">Установить родительский <br>регион - /rg setparent</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
                  <tr>
                    <th scope="row">Установить приоритет <br>региона - /rg setpriority</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
                  <tr>
                    <th scope="row">Выдать опыт себе - /exp</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
                  <tr>
                    <th scope="row">Установить погоду - /weather</th>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                    <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
               
                  </tr>
              </tbody>      
            <thead>
                <tr>
                  <th scope="col" class="text-white" style="font-size: 16px"><i class="fas fa-briefcase mr-2"></i>Внутриигровые наборы</th>
                  <th scope="col" class="text-white text-center" style="font-size: 16px">VIP</th>
                  <th scope="col" class="text-white text-center" style="font-size: 16px">Premium</th>
                  <th scope="col" class="text-white text-center" style="font-size: 16px">Diamond</th>
                  <th scope="col" class="text-white text-center" style="font-size: 16px">Sapphire</th>
                  <th scope="col" class="text-white text-center" style="font-size: 16px">Titan</th>
                  <th scope="col" class="text-white text-center" style="font-size: 16px">Zeus</th>
                </tr>
              </thead>
              <tbody>
                  <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="
                    <img src='/assets/img/donate/kits/technomagic/vip.png' alt=''>
                  "></i>VIP набор - /kit vip</th>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
             </tr>
                <tr>
                  <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="
                    <img src='/assets/img/donate/kits/technomagic/premium.png' alt=''>
                  "></i>Premium набор - /kit premium</th>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
             
                </tr>
                <tr>
                  <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="
                    <img src='/assets/img/donate/kits/technomagic/diamond.png' alt=''>
                  "></i>Diamond набор - /kit diamond</th>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
             
                </tr>
                <tr>
                  <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="
<img src='/assets/img/donate/kits/technomagic/sapphire.jpg' alt=''>
                  "></i>Sapphire набор - /kit sapphire</th>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
             
                </tr>
                <tr>
                  <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="" data-original-title="
                    <img src='/assets/img/donate/kits/technomagic/sapphire.jpg' alt=''>"></i>
                        Titan набор - /kit titan</th>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
             
                </tr>
                <tr>
                  <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="" data-original-title="
                    <img src='/assets/img/donate/kits/technomagic/sapphire.jpg' alt=''>"></i>
                    Zeus набор - /kit zeus</th>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                  <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
             
                </tr>
              </tbody>
          </table></div>
    <div class="tab-pane fade" id="nav-anarchy" role="tabpanel" aria-labelledby="nav-anarchy-tab">
        <table class="table table-dark">
            <thead>
              <tr>
                <th scope="col" class="text-white" style="font-size: 16px"><i class="fab fa-codepen mr-2"></i>Основные возможности</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">Воин</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">Титан</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">Странник</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">Каратель</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">Легенда</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">Мастер</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">Иммортал</th>
                <th scope="col" class="text-white text-center" style="font-size: 16px">Энигма</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Количество приватов</th>
                <td class="text-center">3</td>
                <td class="text-center">5</td>
                <td class="text-center">7</td>
                <td class="text-center">8</td>
                <td class="text-center">10</td>
                <td class="text-center">15</td>
              </tr>
              <tr>
                <th scope="row">Количество точек дома</th>
                <td class="text-center">3</td>
                <td class="text-center">5</td>
                <td class="text-center">7</td>
                <td class="text-center">8</td>
                <td class="text-center">10</td>
                <td class="text-center">15</td>
              </tr>
              <tr>
                <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="
                    <p>user</p>
                    <p>pvp</p>
                    <p>leaf-decay</p>
                "></i>Набор флагов VIP</th>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
           </tr>
              <tr>
                <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="
                    <p>chest-access</p>
                    <p>interact</p>
                    <p>snow-fall</p>
                    <p>ice-melt</p>
                    <p>creeper-explosion</p>
                    <p>greeting</p>
                    <p>farewell</p>
                    <p>enderpearl</p>
                "></i>Набор флагов Premium</th>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
           
              </tr>
              <tr>
                <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="
                    <p>entry</p>
                    <p>mob-spawning</p>
                    <p>item-drop</p>
                    <p>mob-damage</p>
                "></i>Набор флагов Diamond</th>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
           
              </tr>
              <tr>
                <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="
                    <p>time-lock</p>
                    <p>weather-lock</p>
                    <p>item-pickup</p>
                "></i>Набор флагов Sapphire</th>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
           
              </tr>
              <tr>
                <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="" data-original-title="<ul style='margin:0px;padding:5px 5px 5px 10px;list-style:none;'><1.12.2:<br><li>farewell</li><li>ice-melt</li><li>ice-form</li><li>greeting</li><li>leaf-decay</li><li>notify-enter</li><li>notify-leave</li><br>>1.12.2:<li>block-place</li><li>block-break</li><li>interact-block-primary</li></ul>"></i>Набор флагов Titan</th>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
           
              </tr>
              <tr>
                <th scope="row"><i class="fas fa-question-circle mr-2" data-toggle="tooltip" data-html="true" data-placement="auto" title="" data-original-title="<ul style='margin:0px;padding:5px 5px 5px 10px;list-style:none;'><1.12.2:<br><li>farewell</li><li>ice-melt</li><li>ice-form</li><li>greeting</li><li>leaf-decay</li><li>notify-enter</li><li>notify-leave</li><br>>1.12.2:<li>block-place</li><li>block-break</li><li>interact-block-primary</li></ul>"></i>Набор флагов Zeus</th>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-times" style="color:#a2a2a2"></i></td>
                <td class="text-center"><i class="fas fa-check" style="color:#3e9229"></i></td>
           
              </tr>
            </tbody>
          </table>
    </div>
  </div>

@endsection