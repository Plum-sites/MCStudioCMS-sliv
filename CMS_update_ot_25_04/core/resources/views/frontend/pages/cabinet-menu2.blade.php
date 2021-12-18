<form action="#" role="form" method="post">
	@csrf
	<div class="col-md-12 mb-3 mt-1 p-0">
        <select class="form-control select-max-width font-size-for-mobile-17" id="privileges_list_server_id" name="privileges_list_server_id">
            <option value="" selected disabled>Выберите сервер для покупки привилегий</option>
            @foreach($servers as $server)
            <option value="{{ @$server->id }}" data-server-id="" data-server-name="{{ @$server->name }}">{{ @$server->name }}</option>
            @endforeach
        </select>
    </div>

    <div id="load_alert_2" class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert" style="display:none;">
		<div class="alert-group-prepend">
	        <span class="alert-group-icon text-">
	            <i id="load_alert_icon_2" class="fa fa-info-circle"></i>
	        </span>
	    </div>
	    <div class="alert-content">
	        <strong id="load_alert_text_2"></strong>
	    </div>
	</div>

    <div id="load_content_2" class="col-md-12 p-0" style="display:none;">
    	
    </div>
</form>

<script type="text/javascript">

    var privileges_list_server_id = 0;
    var privileges_buys_privilege_id = 0;

    function load_content_2() {
    	$("#load_content_2").slideUp(500);
    	$.ajax({
            type: 'POST',
            url: '{{ route('cabinet.privileges.list') }}',
            data: {
                action: 'list',
                _token: csrf_token,
                privileges_list_server_id: privileges_list_server_id
            },
            success: function (data) {
                privileges_list_server_id = privileges_list_server_id;
                setTimeout(function() {
                    $("#load_alert_2").slideUp(500);
                    $("#load_alert_text_2").html('');
                    $("#load_content_2").html(data).slideDown(500);
                }, 250);
            },
            error: function(data) {
                if(data.status) {
                	$("#load_alert_2").slideDown(500);
                	$("#load_alert_text_2").html('Список в данный момент пуст');
                }
            }
        });
    }

    $(document).on('change', '#privileges_list_server_id', function () {
        privileges_list_server_id = $('#privileges_list_server_id').val();
        load_content_2();
    });

</script>