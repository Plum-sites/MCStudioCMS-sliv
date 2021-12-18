@extends('admin.layouts.master')
@section('page_icon', 'fa fa-cogs')
@section('page_name', 'Настройка рейтинга')
@section('body')
<div class="row">
    @include('admin.layouts.flash')
    <div class="col-md-12">
        <div class="tile-main">
            <div class="tile tile-smot">
                <div class="tile-head">
                </div>
            </div>
            <div class="tile">
                <form method="post" action="{{ route('admin.ratingsList.save')}}">
                    @csrf
                    <div class="tile-body">
                        <h5>Общие настройки голосования</h5>                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Тип призов в рейтинге</b></label>
                                    <select class="form-control select-max-width font-size-for-mobile-17" id="vote_gift_type" name="vote_gift_type">
                                        <option value="1" {{ (@$item->vote_gift_type == 1) ? 'selected' : '0' }}>Игровая валюта</option>
                                        <option value="2" {{ (@$item->vote_gift_type == 2) ? 'selected' : '0' }}>Реальная валюта</option>
                                        {{-- <option value="3" {{ (@$item->vote_gift_type == 3) ? 'selected' : '0' }}>Набор на сервера</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>Кол-во валюты</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ @$item->vote_gift_count }}" placeholder="Кол-во призов" id="vote_gift_count" name="vote_gift_count">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><b>Команда для выдачи набора</b> <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Должна соответствовать команде, через которую выдаются киты на сервере определенному пользователю с использованием переменной %player%."></i></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ @$item->vote_gift_kit }}" placeholder="kit vip %player%" name="vote_gift_kit">
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <h5>Настройки MCRate</h5>
                        <h6>Ваша ссылка на обработчик: https://{{ $_SERVER['SERVER_NAME'] }}/ratings/mcrate <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Указывается в настройках проекта в MCRate"></i></h6>     
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>McRate.Su секретный ключ</b></label>
                                    <div class="input-group">
                                        <input type="password" data-hover-view="password" class="form-control" value="{{ @$item->secret_mcrate }}" placeholder="Секретный ключ" id="secret_mcrate" name="secret_mcrate">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>McRate.Su ссылка для голосования</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ @$item->link_mcrate }}" placeholder="http://mcrate.su/project/ID" id="link_mcrate" name="link_mcrate">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5>Настройки TopCraft</h5>   
                        <h6>Ваша ссылка на обработчик: https://{{ $_SERVER['SERVER_NAME'] }}/ratings/topcraft <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Указывается в настройках проекта в TopCraft"></i> </h6> 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>TopCraft.Ru секретный ключ</b></label>
                                    <div class="input-group">
                                        <input type="password" data-hover-view="password" class="form-control" value="{{ @$item->secret_topcraft }}" placeholder="Секретный ключ" id="secret_topcraft" name="secret_topcraft">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label"><b>TopCraft.Ru ссылка для голосования</b></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ @$item->link_topcraft }}" placeholder="https://topcraft.ru/servers/ID/" id="link_topcraft" name="link_topcraft">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-outline-primary btn-block" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i> Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    $('#vote_gift_type').on('change', function() {
        $('#vote_gift_count').val('');
    });

</script>
@endsection