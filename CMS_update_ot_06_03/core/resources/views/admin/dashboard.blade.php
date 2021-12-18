@extends('admin.layouts.master')
@section('page_icon', 'fa fa-bar-chart')
@section('page_name', 'Статистика сайта')
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="tile-main">
            <div class="tile tile-smot">
                <div class="tile-head">

                </div>
            </div>
            <div class="tile">
                <div class="tile-body">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 px-2">
                            <div class="card" data-toggle="tooltips">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <div class="icon icon-shape icon-md bg-primary shadow-primary text-white">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    <!-- Title -->
                                    <h5 class="h3 font-weight-bolder mb-1">{{ @$users }} чел.</h5>
                                    <!-- Subtitle -->
                                    <span class="d-block text-sm text-muted font-weight-bold">
                                        Пользователей
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 px-2">
                            <div class="card" data-toggle="tooltips">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <div class="icon icon-shape icon-md bg-danger shadow-primary text-white">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    <!-- Title -->
                                    <h5 class="h3 font-weight-bolder mb-1">{{ @$onlines }} чел.</h5>
                                    <!-- Subtitle -->
                                    <span class="d-block text-sm text-muted font-weight-bold">
                                        Общий онлайн
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 px-2">
                            <div class="card" data-toggle="tooltips">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <div class="icon icon-shape icon-md bg-warning shadow-primary text-white">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    <!-- Title -->
                                    <h5 class="h3 font-weight-bolder mb-1">{{ @$payments }} шт.</h5>
                                    <!-- Subtitle -->
                                    <span class="d-block text-sm text-muted font-weight-bold">
                                        Количество платежей
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-md-9">
                            <div class="tile-main">
                                <div class="tile tile-smot">
                                    <div class="tile-head">
                                        <div class="name">
                                            <i class="fa fa-bar-chart"></i>
                                            График платежей
                                        </div>
                                        <div class="icon">
                                            
                                        </div>
                                        <div class="cler"></div>
                                    </div>
                                </div>
                                <div class="tile">
                                    <div class="tile-body">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <canvas class="embed-responsive-item" id="chart_payments"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-lg-4 col-sm-6 px-2">
                            <div class="card">
                                <div class="pl-4 mt-4 mb-0">
                                    <h5>Новые платежи</h5>
                                </div>
                                <div class="card-body">
                                        <ul class="list-group list-group-flush p-0">
                                            @for(@$i=0;@$i<10;@$i++)
                                            @php
                                            $pays = @$users_payment[@$i];
                                            @endphp
                                            <li class="list-group-item p-2" style="{{ (@$i == 0) ? 'padding-top: 0 !important;' : '' }} {{ (@$i == 9) ? 'padding-bottom: 0 !important;' : '' }}">
                                                <div class="widget-content">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left float-left mr-3">
                                                            <img width="35" style="border-radius:3px;" src="/view.php?user={{ (!@$pays->user->username) ? 'default' : @$pays->user->username }}&mode=3&size=35" alt="">
                                                        </div>
                                                        <div class="widget-content-left float-left">
                                                            <div class="widget-heading">
                                                                @if(@$pays->user->username)
                                                                <a href="{{ route('admin.usersList.user', @$pays->user_id) }}">
                                                                    {{ @$pays->user->username }}
                                                                </a>
                                                                @else
                                                                ******
                                                                @endif
                                                            </div>
                                                            <div class="widget-subheading mt-1 opacity-10">
                                                                <div class="badge badge-pill @if(@$pays->status == 0) badge-danger @else badge-primary @endif" style="border-radius:3px;"  data-toggle="tooltips" data-placement="left" @if(@$pays->status == 0) title="Не оплачено" @else title="Оплачено" @endif>
                                                                    
                                                                    @if(@$pays->money)
                                                                    +{{ @$pays->money }} {{ @$general->currency_symbol }}
                                                                    @else
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-right float-right">
                                                            <div class="fsize-2 text-success" data-toggle="tooltips" data-placement="left" title="ID платежа">
                                                                <span>
                                                                    #{{ (!@$pays->id) ? '0' : @$pays->id }} 
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="clear-both"></div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="row">
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title" style="font-size: 22px;">Статистика заказов по дням за месяц</h3>
            <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="lineChart1"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title" style="font-size: 22px;">Статистика заказов по месяцам за год</h3>
            <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="lineChart2"></canvas>
            </div>
        </div>
    </div>
</div> -->
<!-- 
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">Статистика заказов по годам</h3>
            <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="lineChart3"></canvas>
            </div>
        </div>
    </div>
</div>
 -->
@endsection
@section('scripts')
<script type="text/javascript">
    var d1 = {!! json_encode(@$d1_payments) !!};
    var m1 =  {!! json_encode(@$m1_payments) !!};
    var data1 = {
        labels: d1,
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(47, 79, 79,0.2)",
                strokeColor: "rgba(47, 79, 79,1)",
                pointColor: "rgba(47, 79, 79,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: m1
            }
        ]
    };
    var options1 = {
        tooltipTemplate: "<%if (label){%><%=label %>: <%}%><%= value + ' шт.' %>",
        multiTooltipTemplate: "<%= value + ' шт.' %>",
    };

    var ctxl1 = $("#chart_payments").get(0).getContext("2d");
    var chart_payments = new Chart(ctxl1).Line(data1, options1);
</script>
@endsection