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
<p>Хотите прокачать возможности своего аккаунта? Получить максимум удовольствия от любимой игры? Для Вас мы готовые предложить нечто особенное! 
Выберите свой сервер, кликнув ниже по нужному варианту.</p>
<ul class="nav mb-2">
    <li class="nav-item col-12 col-md-6 col-sm-6 col-xs-6 p-0 pr-2 mt-2">
      <a class="nav-link active case" data-toggle="tab" href="#nav-sandbox" role="tab" aria-controls="nav-sandbox" aria-selected="true">
          <span><h5>SandBox</h5></span>  
            <p>Новое измерение и интересная генерация мира привнесли в сервер изюминку. Множество декоративных блоков и предметов для осуществления ваших архитектурных мечтаний.</p>
      </a>
    </li>
    <li class="nav-item col-12 col-md-6 col-sm-6 col-xs-6 p-0 pr-2 mt-2">
      <a class="nav-link case" data-toggle="tab" href="#nav-technomagic" role="tab" aria-controls="nav-technomagic" aria-selected="true">
          <span><h5>TechnoMagic</h5></span>  
            <p>Магическо-технический сервер сочетающий в себе чародейство, запретную магию и новое измерение для получения трофеев с автоматизацией крафтов и более сотни механизмов для обработки руд и др.процессов.</p>
      </a>
    </li>
    <li class="nav-item col-12 col-md-6 col-sm-6 col-xs-6 p-0 pr-2 mt-2">
      <a class="nav-link case" data-toggle="tab" href="#nav-magicrpg" role="tab" aria-controls="nav-magicrpg" aria-selected="true">
          <span><h5>MagicRPG</h5></span>  
            <p>Ритуалы и кровяное искусство. Не забыли и про сильных боссов в новом измерении, а также про усиленных мобов для незабываемых эмоций от игры. Для комфортных сражений подготовили инструменты и оружие.</p>
      </a>
    </li>
    <li class="nav-item col-12 col-md-6 col-sm-6 col-xs-6 p-0 pr-2 mt-2">
      <a class="nav-link case" data-toggle="tab" href="#nav-hitech" role="tab" aria-controls="nav-hitech" aria-selected="true">
          <span><h5>HiTech</h5></span>  
            <p>Технологии в китайском мире с возможностью постройки огромнейших реакторов и мощных возведений из механизмов.</p>
      </a>
    </li>
    <li class="nav-item col-12 col-md-6 col-sm-6 col-xs-6 p-0 pr-2 mt-2">
      <a class="nav-link case" data-toggle="tab" href="#nav-hardmagictech" role="tab" aria-controls="nav-hardmagictech" aria-selected="true">
          <span><h5>HardMagicTech</h5></span>  
            <p>Хардкор во всех его проявлениях к TechnoMagic серверу: пол животных, реалистичное создание книг, ночная темнота, переработанная механика голода и жажды, зыбучие пески и даже факелы с поджогом.</p>
      </a>
    </li>
    <li class="nav-item col-12 col-md-6 col-sm-6 col-xs-6 p-0 pr-2 mt-2">
      <a class="nav-link case" data-toggle="tab" href="#nav-majestic" role="tab" aria-controls="nav-majestic" aria-selected="true">
          <span><h5>Majestic</h5></span>  
            <p>Удивительный магическо-технический сервер с 4 видами магии, новым измерением для получения трофеев, автоматизацией крафтов и более сотни механизмов для обработки руд и других процессов.</p>
      </a>
    </li>
    <li class="nav-item col-12 col-md-6 col-sm-6 col-xs-6 p-0 pr-2 mt-2">
      <a class="nav-link case" data-toggle="tab" href="#nav-wizard" role="tab" aria-controls="nav-wizard" aria-selected="true">
          <span><h5>Wizard</h5></span>  
            <p>Магический сервер с уникальными деревьями и анимацией их падения, целых 8 видов магии и более 15 дополнений к ним. Мы не забыли и про сильных боссов в новом измерении, а также про усиленных мобов.</p>
      </a>
    </li>
    <li class="nav-item col-12 col-md-6 col-sm-6 col-xs-6 p-0 pr-2 mt-2">
      <a class="nav-link case" data-toggle="tab" href="#nav-technology" role="tab" aria-controls="nav-technology" aria-selected="true">
          <span><h5>Technology</h5></span>  
            <p>Технический сервер c большим количеством механизмов. Для быстрого получения ресурсов используйте многоблочные структуры и стройте огромные заводы. Станьте магнатом этого сервера.</p>
      </a>
    </li>
    <li class="nav-item col-12 col-md-6 col-sm-6 col-xs-6 p-0 pr-2 mt-2">
      <a class="nav-link case" data-toggle="tab" href="#nav-pixelmon" role="tab" aria-controls="nav-pixelmon" aria-selected="true">
          <span><h5>Pixelmon</h5></span>  
            <p>Захотелось личного покемона? Тогда скорее собирайте априкорны по миру, обжаривайте и создавайте покебол для поимки этих прекрасных существ. Анализируйте их способности и устраивайте битвы!</p>
      </a>
    </li>
  </ul>

<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
	<div class="tab-pane fade show active" id="nav-sandbox" role="tabpanel" aria-labelledby="nav-sandbox-tab">
		<div class="card bg-gradient-primary border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">VIP</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">4 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1 штука</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">3 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">500.000</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Надеть блок на голову:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/hat</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ec</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp create</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp delete</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[VIP] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>

		<div class="card bg-gradient-dark border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h4 text-white mb-0" style="text-shadow: white 0 0 0.5em;">PREMIUM</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">6 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">2 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">5 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1.000.000</p>
		                <h5 class="text-white h6 mt-4 mb-1">Все возможности:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">группы VIP</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задержка на команды:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">снижена</p>
		                <h5 class="text-white h6 mt-4 mb-1">Сохранение при смерти:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">опыта и инвентаря</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		                <h5 class="text-white h6 mt-4 mb-1">Надеть блок на голову:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/hat</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ec</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp create</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp delete</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Режим полета:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/fly</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить свое время:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ptime</p>
		                <h5 class="text-white h6 mt-4 mb-1">Прыгнуть:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/jump</p>
		                <h5 class="text-white h6 mt-4 mb-1">Починить вещь:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/repair</p>
		                <h5 class="text-white h6 mt-4 mb-1">Режим бессмертия:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/god</p>
		                <h5 class="text-white h6 mt-4 mb-1">Тп по координатам:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/tppos</p>
		                <h5 class="text-white h6 mt-4 mb-1">Выдать опыт:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/exp</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Установить владельца рг:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setparent</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задать приоритет региона:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setpriority</p>
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt, creeper-explosion, greeting, farewell, enderpearl, entry, mpb-spawning, item-drop, mob-damage, time-lock, weather-lock, item-pickup</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[PREMIUM] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>
		<div class="col-12 text-center">
    		<a href="{{ route('cabinet') }}" class="btn btn-primary btn-xl text-uppercase">Прокачать свой аккаунт!</a>
		</div>
	</div>
	<div class="tab-pane fade show" id="nav-technomagic" role="tabpanel" aria-labelledby="nav-technomagic-tab">
		<div class="card bg-gradient-primary border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">VIP</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">4 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1 штука</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">3 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">500.000</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Надеть блок на голову:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/hat</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ec</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp create</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp delete</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[VIP] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>

		<div class="card bg-gradient-dark border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h4 text-white mb-0" style="text-shadow: white 0 0 0.5em;">PREMIUM</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">6 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">2 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">5 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1.000.000</p>
		                <h5 class="text-white h6 mt-4 mb-1">Все возможности:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">группы VIP</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задержка на команды:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">снижена</p>
		                <h5 class="text-white h6 mt-4 mb-1">Сохранение при смерти:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">опыта и инвентаря</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		                <h5 class="text-white h6 mt-4 mb-1">Надеть блок на голову:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/hat</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ec</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp create</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp delete</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Режим полета:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/fly</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить свое время:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ptime</p>
		                <h5 class="text-white h6 mt-4 mb-1">Прыгнуть:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/jump</p>
		                <h5 class="text-white h6 mt-4 mb-1">Починить вещь:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/repair</p>
		                <h5 class="text-white h6 mt-4 mb-1">Режим бессмертия:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/god</p>
		                <h5 class="text-white h6 mt-4 mb-1">Тп по координатам:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/tppos</p>
		                <h5 class="text-white h6 mt-4 mb-1">Выдать опыт:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/exp</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Установить владельца рг:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setparent</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задать приоритет региона:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setpriority</p>
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt, creeper-explosion, greeting, farewell, enderpearl, entry, mpb-spawning, item-drop, mob-damage, time-lock, weather-lock, item-pickup</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[PREMIUM] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>
		<div class="col-12 text-center">
    		<a href="{{ route('cabinet') }}" class="btn btn-primary btn-xl text-uppercase">Прокачать свой аккаунт!</a>
		</div>
	</div>
	<div class="tab-pane fade show" id="nav-magicrpg" role="tabpanel" aria-labelledby="nav-magicrpg-tab">
		<div class="card bg-gradient-primary border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">VIP</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">4 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1 штука</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">3 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">500.000</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Надеть блок на голову:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/hat</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ec</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp create</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp delete</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[VIP] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>

		<div class="card bg-gradient-dark border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h4 text-white mb-0" style="text-shadow: white 0 0 0.5em;">PREMIUM</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">6 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">2 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">5 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1.000.000</p>
		                <h5 class="text-white h6 mt-4 mb-1">Все возможности:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">группы VIP</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задержка на команды:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">снижена</p>
		                <h5 class="text-white h6 mt-4 mb-1">Сохранение при смерти:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">опыта и инвентаря</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		                <h5 class="text-white h6 mt-4 mb-1">Надеть блок на голову:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/hat</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ec</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp create</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp delete</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Режим полета:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/fly</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить свое время:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ptime</p>
		                <h5 class="text-white h6 mt-4 mb-1">Прыгнуть:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/jump</p>
		                <h5 class="text-white h6 mt-4 mb-1">Починить вещь:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/repair</p>
		                <h5 class="text-white h6 mt-4 mb-1">Режим бессмертия:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/god</p>
		                <h5 class="text-white h6 mt-4 mb-1">Тп по координатам:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/tppos</p>
		                <h5 class="text-white h6 mt-4 mb-1">Выдать опыт:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/exp</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Установить владельца рг:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setparent</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задать приоритет региона:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setpriority</p>
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt, creeper-explosion, greeting, farewell, enderpearl, entry, mpb-spawning, item-drop, mob-damage, time-lock, weather-lock, item-pickup</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[PREMIUM] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>
		<div class="col-12 text-center">
    		<a href="{{ route('cabinet') }}" class="btn btn-primary btn-xl text-uppercase">Прокачать свой аккаунт!</a>
		</div>
	</div>
	<div class="tab-pane fade show" id="nav-hitech" role="tabpanel" aria-labelledby="nav-hitech-tab">
		<div class="card bg-gradient-primary border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">VIP</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">4 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1 штука</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">3 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">500.000</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Надеть блок на голову:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/hat</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ec</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp create</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp delete</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[VIP] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>

		<div class="card bg-gradient-dark border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h4 text-white mb-0" style="text-shadow: white 0 0 0.5em;">PREMIUM</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">6 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">2 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">5 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1.000.000</p>
		                <h5 class="text-white h6 mt-4 mb-1">Все возможности:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">группы VIP</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задержка на команды:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">снижена</p>
		                <h5 class="text-white h6 mt-4 mb-1">Сохранение при смерти:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">опыта и инвентаря</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		                <h5 class="text-white h6 mt-4 mb-1">Надеть блок на голову:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/hat</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ec</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp create</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp delete</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Режим полета:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/fly</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить свое время:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ptime</p>
		                <h5 class="text-white h6 mt-4 mb-1">Прыгнуть:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/jump</p>
		                <h5 class="text-white h6 mt-4 mb-1">Починить вещь:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/repair</p>
		                <h5 class="text-white h6 mt-4 mb-1">Режим бессмертия:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/god</p>
		                <h5 class="text-white h6 mt-4 mb-1">Тп по координатам:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/tppos</p>
		                <h5 class="text-white h6 mt-4 mb-1">Выдать опыт:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/exp</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Установить владельца рг:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setparent</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задать приоритет региона:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setpriority</p>
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt, creeper-explosion, greeting, farewell, enderpearl, entry, mpb-spawning, item-drop, mob-damage, time-lock, weather-lock, item-pickup</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[PREMIUM] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>
		<div class="col-12 text-center">
    		<a href="{{ route('cabinet') }}" class="btn btn-primary btn-xl text-uppercase">Прокачать свой аккаунт!</a>
		</div>
	</div>
	<div class="tab-pane fade show" id="nav-hardmagictech" role="tabpanel" aria-labelledby="nav-hardmagictech-tab">
		<div class="card bg-gradient-primary border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">VIP</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">4 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1 штука</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">3 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">500.000</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Надеть блок на голову:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/hat</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ec</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp create</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp delete</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[VIP] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>

		<div class="card bg-gradient-dark border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h4 text-white mb-0" style="text-shadow: white 0 0 0.5em;">PREMIUM</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">6 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">2 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">5 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1.000.000</p>
		                <h5 class="text-white h6 mt-4 mb-1">Все возможности:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">группы VIP</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задержка на команды:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">снижена</p>
		                <h5 class="text-white h6 mt-4 mb-1">Сохранение при смерти:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">опыта и инвентаря</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		                <h5 class="text-white h6 mt-4 mb-1">Надеть блок на голову:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/hat</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ec</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp create</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/warp delete</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Режим полета:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/fly</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить свое время:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ptime</p>
		                <h5 class="text-white h6 mt-4 mb-1">Прыгнуть:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/jump</p>
		                <h5 class="text-white h6 mt-4 mb-1">Починить вещь:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/repair</p>
		                <h5 class="text-white h6 mt-4 mb-1">Режим бессмертия:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/god</p>
		                <h5 class="text-white h6 mt-4 mb-1">Тп по координатам:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/tppos</p>
		                <h5 class="text-white h6 mt-4 mb-1">Выдать опыт:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/exp</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Установить владельца рг:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setparent</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задать приоритет региона:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setpriority</p>
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt, creeper-explosion, greeting, farewell, enderpearl, entry, mpb-spawning, item-drop, mob-damage, time-lock, weather-lock, item-pickup</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[PREMIUM] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>
		<div class="col-12 text-center">
    		<a href="{{ route('cabinet') }}" class="btn btn-primary btn-xl text-uppercase">Прокачать свой аккаунт!</a>
		</div>
	</div>
	<div class="tab-pane fade show" id="nav-majestic" role="tabpanel" aria-labelledby="nav-majestic-tab">
		<div class="card bg-gradient-primary border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">VIP</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">4 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1 штука</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">3 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">500.000</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ender</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/setwarp</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/removewarp</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[VIP] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>

		<div class="card bg-gradient-dark border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h4 text-white mb-0" style="text-shadow: white 0 0 0.5em;">PREMIUM</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">6 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">2 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">5 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1.000.000</p>
		                <h5 class="text-white h6 mt-4 mb-1">Все возможности:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">группы VIP</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задержка на команды:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">снижена</p>
		                <h5 class="text-white h6 mt-4 mb-1">Сохранение при смерти:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">опыта и инвентаря</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ender</p>
		                <h5 class="text-white h6 mt-4 mb-1">Режим полета:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/fly</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить свое время:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ptime</p>
		                <h5 class="text-white h6 mt-4 mb-1">Прыгнуть:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/jump</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Починить вещь:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/repair</p>
		                <h5 class="text-white h6 mt-4 mb-1">Режим бессмертия:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/god</p>
		                <h5 class="text-white h6 mt-4 mb-1">Тп по координатам:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/tppos</p>
		                <h5 class="text-white h6 mt-4 mb-1">Выдать опыт:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/exp</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет кожаной брони:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/dye</p>
		                <h5 class="text-white h6 mt-4 mb-1">Светиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/glow</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/setwarp</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/removewarp</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Установить владельца рг:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setparent</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задать приоритет региона:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setpriority</p>
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt, creeper-explosion, greeting, farewell, enderpearl, entry, mpb-spawning, item-drop, mob-damage, time-lock, weather-lock, item-pickup</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[PREMIUM] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>
		<div class="col-12 text-center">
    		<a href="{{ route('cabinet') }}" class="btn btn-primary btn-xl text-uppercase">Прокачать свой аккаунт!</a>
		</div>
	</div>
	<div class="tab-pane fade show" id="nav-wizard" role="tabpanel" aria-labelledby="nav-wizard-tab">
		<div class="card bg-gradient-primary border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">VIP</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">4 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1 штука</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">3 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">500.000</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ender</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/setwarp</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/removewarp</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[VIP] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>

		<div class="card bg-gradient-dark border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h4 text-white mb-0" style="text-shadow: white 0 0 0.5em;">PREMIUM</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">6 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">2 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">5 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1.000.000</p>
		                <h5 class="text-white h6 mt-4 mb-1">Все возможности:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">группы VIP</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задержка на команды:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">снижена</p>
		                <h5 class="text-white h6 mt-4 mb-1">Сохранение при смерти:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">опыта и инвентаря</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ender</p>
		                <h5 class="text-white h6 mt-4 mb-1">Режим полета:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/fly</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить свое время:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ptime</p>
		                <h5 class="text-white h6 mt-4 mb-1">Прыгнуть:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/jump</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Починить вещь:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/repair</p>
		                <h5 class="text-white h6 mt-4 mb-1">Режим бессмертия:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/god</p>
		                <h5 class="text-white h6 mt-4 mb-1">Тп по координатам:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/tppos</p>
		                <h5 class="text-white h6 mt-4 mb-1">Выдать опыт:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/exp</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет кожаной брони:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/dye</p>
		                <h5 class="text-white h6 mt-4 mb-1">Светиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/glow</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/setwarp</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/removewarp</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Установить владельца рг:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setparent</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задать приоритет региона:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setpriority</p>
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt, creeper-explosion, greeting, farewell, enderpearl, entry, mpb-spawning, item-drop, mob-damage, time-lock, weather-lock, item-pickup</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[PREMIUM] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>
		<div class="col-12 text-center">
    		<a href="{{ route('cabinet') }}" class="btn btn-primary btn-xl text-uppercase">Прокачать свой аккаунт!</a>
		</div>
	</div>
	<div class="tab-pane fade show" id="nav-technology" role="tabpanel" aria-labelledby="nav-technology-tab">
		<div class="card bg-gradient-primary border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">VIP</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">4 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1 штука</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">3 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">500.000</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ender</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/setwarp</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/removewarp</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[VIP] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>

		<div class="card bg-gradient-dark border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h4 text-white mb-0" style="text-shadow: white 0 0 0.5em;">PREMIUM</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">6 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">2 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">5 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1.000.000</p>
		                <h5 class="text-white h6 mt-4 mb-1">Все возможности:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">группы VIP</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задержка на команды:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">снижена</p>
		                <h5 class="text-white h6 mt-4 mb-1">Сохранение при смерти:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">опыта и инвентаря</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ender</p>
		                <h5 class="text-white h6 mt-4 mb-1">Режим полета:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/fly</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить свое время:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ptime</p>
		                <h5 class="text-white h6 mt-4 mb-1">Прыгнуть:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/jump</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Починить вещь:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/repair</p>
		                <h5 class="text-white h6 mt-4 mb-1">Режим бессмертия:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/god</p>
		                <h5 class="text-white h6 mt-4 mb-1">Тп по координатам:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/tppos</p>
		                <h5 class="text-white h6 mt-4 mb-1">Выдать опыт:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/exp</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет кожаной брони:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/dye</p>
		                <h5 class="text-white h6 mt-4 mb-1">Светиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/glow</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/setwarp</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/removewarp</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Установить владельца рг:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setparent</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задать приоритет региона:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setpriority</p>
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt, creeper-explosion, greeting, farewell, enderpearl, entry, mpb-spawning, item-drop, mob-damage, time-lock, weather-lock, item-pickup</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[PREMIUM] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>
		<div class="col-12 text-center">
    		<a href="{{ route('cabinet') }}" class="btn btn-primary btn-xl text-uppercase">Прокачать свой аккаунт!</a>
		</div>
	</div>
	<div class="tab-pane fade show" id="nav-pixelmon" role="tabpanel" aria-labelledby="nav-pixelmon-tab">
		<div class="card bg-gradient-primary border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h2 text-white mb-0" style="text-shadow: white 0 0 0.5em;">VIP</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">4 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1 штука</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">3 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">500.000</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ender</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/setwarp</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/removewarp</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[VIP] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>

		<div class="card bg-gradient-dark border-0 rounded-lg" style="max-width: 100%;">
		    <div class="card-body px-5">
		        <div class="align-items-center">
		            <span class="h4 text-white mb-0" style="text-shadow: white 0 0 0.5em;">PREMIUM</span>
		        </div>

		        <div class="row">
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Количество домов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">6 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Варпов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">2 штуки</p>
		                <h5 class="text-white h6 mt-4 mb-1">Приватов:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">5 штук</p>
		                <h5 class="text-white h6 mt-4 mb-1">Размер привата:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">1.000.000</p>
		                <h5 class="text-white h6 mt-4 mb-1">Все возможности:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">группы VIP</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задержка на команды:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">снижена</p>
		                <h5 class="text-white h6 mt-4 mb-1">Сохранение при смерти:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">опыта и инвентаря</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Вернуться на точку:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/back</p>
		                <h5 class="text-white h6 mt-4 mb-1">Открыть верстак:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/craft</p>
		                <h5 class="text-white h6 mt-4 mb-1">Покушать:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/feed</p>
		                <h5 class="text-white h6 mt-4 mb-1">Полечиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/heal</p>
		                <h5 class="text-white h6 mt-4 mb-1">Эндер-сундук:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ender</p>
		                <h5 class="text-white h6 mt-4 mb-1">Режим полета:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/fly</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить свое время:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/ptime</p>
		                <h5 class="text-white h6 mt-4 mb-1">Прыгнуть:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/jump</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Починить вещь:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/repair</p>
		                <h5 class="text-white h6 mt-4 mb-1">Режим бессмертия:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/god</p>
		                <h5 class="text-white h6 mt-4 mb-1">Тп по координатам:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/tppos</p>
		                <h5 class="text-white h6 mt-4 mb-1">Выдать опыт:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/exp</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет кожаной брони:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/dye</p>
		                <h5 class="text-white h6 mt-4 mb-1">Светиться:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/glow</p>
		                <h5 class="text-white h6 mt-4 mb-1">Установить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/setwarp</p>
		                <h5 class="text-white h6 mt-4 mb-1">Удалить варп:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/removewarp</p>
		            </div>
		            <div class="col-md-3">
		                <h5 class="text-white h6 mt-4 mb-1">Установить владельца рг:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setparent</p>
		                <h5 class="text-white h6 mt-4 mb-1">Задать приоритет региона:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">/rg setpriority</p>
		                <h5 class="text-white h6 mt-4 mb-1">Флаги WorldGuard:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">use, pvp, leaf-decay, chest-access, interact, snow-fall, ice-melt, creeper-explosion, greeting, farewell, enderpearl, entry, mpb-spawning, item-drop, mob-damage, time-lock, weather-lock, item-pickup</p>
		                <h5 class="text-white h6 mt-4 mb-1">Префикс в чате и над головой:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">[PREMIUM] Никнейм</p>
		                <h5 class="text-white h6 mt-4 mb-1">Цвет сообщения:</h5>
		                <p class="text-sm text-white opacity-5 mb-0">Серый</p>
		            </div>
		        </div>
    		</div>
		</div>
		<div class="col-12 text-center">
    		<a href="{{ route('cabinet') }}" class="btn btn-primary btn-xl text-uppercase">Прокачать свой аккаунт!</a>
		</div>
	</div>
</div>

@endsection