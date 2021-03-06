<form action="#" role="form" method="post">
	@csrf
	<div class="col-md-12 mb-3 mt-1 p-0">
        <select class="form-control select-max-width font-size-for-mobile-17" id="kits_list_server_id" name="kits_list_server_id">
            <option value="" selected disabled>Выберите сервер для покупки наборов</option>
            @foreach($servers as $server)
            <option value="{{ @$server->id }}" data-server-id="" data-server-name="{{ @$server->name }}">{{ @$server->name }}</option>
            @endforeach
        </select>
    </div>

    <div id="load_alert_4" class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert" style="display:none;">
		<div class="alert-group-prepend">
	        <span class="alert-group-icon text-">
	            <i id="load_alert_icon_4" class="fa fa-info-circle"></i>
	        </span>
	    </div>
	    <div class="alert-content">
	        <strong id="load_alert_text_4"></strong>
	    </div>
	</div>

    <div id="load_content_4" class="col-md-12 p-0" style="display:none;">
    	
    </div>
</form>

<script type="text/javascript">

    function load_content_4() {
    	$("#load_content_4").slideUp(500);
    	$.ajax({
            type: 'POST',
            url: '{{ route('cabinet.kits.list') }}',
            data: {
                action: 'list',
                _token: csrf_token,
                kits_list_server_id: $('#kits_list_server_id').val()
            },
            success: function (data) {
                setTimeout(function() {
                    $("#load_alert_4").slideUp(500);
                    $("#load_alert_text_4").html('');
                    $("#load_content_4").html(data).slideDown(500);
                }, 250);
            },
            error: function(data) {
                if(data.status) {
                	$("#load_alert_4").slideDown(500);
                	$("#load_alert_text_4").html('Список в данный момент пуст');
                }
            }
        });
    }

    $(document).on('change', '#kits_list_server_id', function () {
        load_content_4();
    });

</script>