@if(count(@$banlist) >= 1)
<div class="table-responsive">
    <table class="table table-lg table-expand w-100">
        <thead>
            <tr>
                <th style="min-width:125px;max-width:125px;">ИГРОК</th>
                <th style="min-width:117px;max-width:117px;">ЗАБАНИЛ</th>
                <th style="min-width:134px;max-width:134px;">ПРИЧИНА</th>
                <th style="min-width:163px;max-width:163px;">БЛОКИРОВКА</th>
                <th style="min-width:163px;max-width:163px;">ОКОНЧАНИЕ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banlist as $ban)
                @if(@$ban->useruuid->username && @$ban->active == 1)
                    <tr class="wow pulse" data-wow-delay="0.3s">
                        <td>{{ @$ban->useruuid->username }}</td>
                        <td>
                            <span>
                                @if(@$ban->banned_by_uuid == "CONSOLE")
                                    CONSOLE
                                @else
                                    {{ @$ban->adminuuid->username }}
                                @endif
                            </span>
                        </td>
                        <td>
                            <span title="{{ @$ban->reason }}">
                                {{ mb_strimwidth(@$ban->reason, 0, 13, "...") }}
                            </span>
                        </td>
                        <td>{{ date("d.m.Y H:i", substr(@$ban->time, 0, strlen(@$ban->time)-3)) }}</td>
                        <td>
                            <span>
                                @if(@$ban->until == "-1")
                                    <span color="red" title="Перманентно - навсегда">
                                        ПЕРМАНЕНТНО
                                    </span>
                                @else
                                    {{ date("d.m.Y H:i", substr(@$ban->until, 0, strlen(@$ban->until)-3)) }}
                                @endif
                            </span>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="alert alert-group alert-primary alert-dismissible fade show alert-icon mt-1" role="alert">
    <div class="alert-group-prepend">
        <span class="alert-group-icon text-">
            <i class="fa fa-info-circle"></i>
        </span>
    </div>
    <div class="alert-content">
        <strong>В данный момент список заблокированных на выбранном сервере пуст</strong>
    </div>
</div>
@endif