@if(count(@$servers_prefix) >= 1)
<form action="#" role="form" method="post">
	@csrf
	<div class="col-md-12 mb-3 mt-1 p-0">
        <select class="form-control select-max-width font-size-for-mobile-17" id="prefix_list_server_id" name="prefix_list_server_id">
            <option value="" selected disabled>Выберите сервер для смены префикса</option>
            @foreach($servers_prefix as $server)
            <option value="{{ @$server->id }}" data-server-id="" data-server-name="{{ @$server->name }}">{{ @$server->name }}</option>
            @endforeach
        </select>
    </div>

    <div id="load_alert_3" class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert" style="display:none;">
		<div class="alert-group-prepend">
	        <span class="alert-group-icon text-">
	            <i id="load_alert_icon_3" class="fa fa-info-circle"></i>
	        </span>
	    </div>
	    <div class="alert-content">
	        <strong id="load_alert_text_3"></strong>
	    </div>
	</div>

    <div id="load_content_3" class="col-md-12 p-0" style="display:none;">
    	
    </div>
</form>
<script type="text/javascript">

    var prefixex_message_on = true;
    var prefixex_messages_text = [
        'Всем привет!',
        'Как дела?',
        'Как погода?',
        'Где крипер?',
        'Где зомби?',
        'Где спавн?',
        'Где шахта?',
        'Где золото?',
        'Пошли в шахту?',
        'Пошли на спавн?',
        'Пошли на PvP?',
        'Дайте меч',
        'Дайте кирку',
        'Дайте алмаз',
        'Дайте лопату',
        'Дайте топор',
        ''
    ];

    var prefix_list_server_id = 0;

    function load_content_3() {
    	$("#load_content_3").slideUp(500);
    	$.ajax({
            type: 'POST',
            url: '{{ route('cabinet.prefix.list') }}',
            data: {
                action: 'list',
                _token: csrf_token,
                prefix_list_server_id: prefix_list_server_id
            },
            success: function (data) {
                setTimeout(function() {
                    $("#load_alert_3").slideUp(500);
                    $("#load_alert_text_3").html('');
                    $("#load_content_3").html(data).slideDown(500);
                }, 250);
            },
            error: function(data) {
                if(data.status) {
                	$("#load_alert_3").slideDown(500);
                	$("#load_alert_text_3").html('В данный момент, установка префикса невозможна');
                }
            }
        });
    }

    $(document).on('change', '#prefix_list_server_id', function () {
        prefix_list_server_id = $('#prefix_list_server_id').val();
        load_content_3();
    });

</script>
@else
<div class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert">
    <div class="alert-group-prepend">
        <span class="alert-group-icon text-">
            <i class="fa fa-info-circle"></i>
        </span>
    </div>
    <div class="alert-content">
        <strong>
            У Вас нет привилегий, которым разрешено устанавливать префикс
        </strong>
    </div>
</div>
@endif