@extends('frontend.layouts.master')
@section('page_title', 'Бан-лист')
@section('body')
<form action="#" role="form" method="post">
	@csrf
	<div class="col-md-12 mb-3 mt-1 p-0">
        <select class="form-control select-max-width font-size-for-mobile-17" id="server_id" name="server_id">
            <option value="" selected disabled>Выберите сервер для просмотра списка</option>
            @foreach($servers as $server)
            <option value="{{ @$server->id }}" data-server-id="" data-server-name="{{ @$server->name }}">Сервер {{ @$server->name }}</option>
            @endforeach
        </select>
    </div>

    <div id="load_alert" class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert" style="display:none;">
		<div class="alert-group-prepend">
	        <span class="alert-group-icon text-">
	            <i id="load_alert_icon" class="fa fa-info-circle"></i>
	        </span>
	    </div>
	    <div class="alert-content">
	        <strong id="load_alert_text"></strong>
	    </div>
	</div>

    <div id="load_content" class="col-md-12 p-0" style="display:none;">
    	
    </div>
</form>

<script type="text/javascript">

    var hash_page = 1;
    window.location.hash = hash_page;
    
    $(window).on('hashchange', function() {
        if(window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if(page == Number.NaN || page <= 0) {
                return false;
            } else {
                hash_page = page;
            }
        }
    });

    function load_content() {
    	$("#load_content").slideUp(500);
    	$.ajax({
            type: 'POST',
            url: '{{ route('banlist.list') }}',
            data: {
                action: 'list',
                _token: csrf_token,
                server_id: $('#server_id').val()
            },
            success: function (data) {
                setTimeout(function() {
                    $("#load_content").html(data).slideDown(500);
                    // $("#load_alert").slideDown(500);
                    // $("#load_alert_text").html('Список заблокированных игроков на сервере <b>' + $("#server_id option:selected").data('server-name') + '</b>');
                }, 500);
            },
            error: function(data) {
                if(data.status) {
                	$("#load_alert").slideDown(500);
                	$("#load_alert_text").html('Список в данный момент пуст');
                }
            }
        });
    }

    $(document).on('change', '#server_id', function () {
        hash_page = 1;
        window.location.hash = hash_page;
        load_content();
    });

</script>
@endsection