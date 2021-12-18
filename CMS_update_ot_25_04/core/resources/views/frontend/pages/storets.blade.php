@extends('frontend.layouts.master')
@section('page_title', 'Онлайн магазин')
@section('body')
@if(@Auth::user()->id)
	<form action="#" role="form" method="post">
		@csrf
		<div class="col-md-12 mb-3 mt-1 p-0">
	        <div class="row">
	            <div class="col-md-6">
	                <select class="form-control select-max-width font-size-for-mobile-17" id="storets_list_server_id" name="storets_list_server_id">
	                    <option value="" selected disabled>Выберите сервер</option>
	                    @foreach($servers as $server)
	                    <option value="{{ @$server->id }}" data-server-id="{{ @$server->id }}" data-server-name="{{ @$server->name }}">{{ @$server->name }}</option>
	                    @endforeach
	                </select>
	            </div>
	            <div id="storets_catogory" class="col-md-6">
	                <select class="form-control select-max-width font-size-for-mobile-17" id="storets_list_catogory_id" name="storets_list_catogory_id" disabled>
	                    <option value="" selected disabled>Выберите категорию товара</option>
	                </select>
	            </div>
	        </div>
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

	    var storets_list_server_id = 0;
	    var storets_list_catogory_id = 0;

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
	        storets_list_server_id = $('#storets_list_server_id').val();
	        storets_list_catogory_id = $('#storets_list_catogory_id').val();
	    	$("#load_content").slideUp(500);
	    	$.ajax({
	            type: 'POST',
	            url: '{{ route('storets.load') }}',
	            data: {
	                action: 'list',
	                _token: csrf_token,
	                storets_list_server_id: storets_list_server_id,
	                storets_list_catogory_id: storets_list_catogory_id
	            },
	            success: function (data) {
	            	if(!storets_list_catogory_id && storets_list_server_id) {
	            		$('#storets_list_catogory_id').attr('disabled', false);
	            		$('#storets_list_catogory_id').html('');
	            		$('#storets_list_catogory_id').html('<option value="" selected disabled>Выберите категорию товара</option>');
	            		$.each(data, function (index, value) {
	                        $('#storets_list_catogory_id').append('<option value="' + value.id + '" data-catogory-id="' + value.id + '" data-catogory-name="' + value.name + '">' + value.name + '</option>');
	                    });
	            	} else {
	            		$("#load_content").html(data).slideDown(500);
		                $("#load_alert").slideDown(500);
		            	$("#load_alert_text").html('Список товаров категории ' + $("#storets_list_catogory_id option:selected").data('catogory-name') + '  на сервере <b>' + $("#storets_list_server_id option:selected").data('server-name') + '</b>');
	            	}
	            },
	            error: function(data) {
	            	$('#storets_list_catogory_id').html('');
	            	$('#storets_list_catogory_id').html('<option value="" selected disabled>Выберите категорию товара</option>');
	                if(data.status) {
	                	$("#load_alert").slideDown(500);
	                	$("#load_alert_text").html('Список товаров в данный момент пуст');
	                }
	            }
	        });
	    }

	    $(document).on('change', '#storets_list_server_id', function () {
	        hash_page = 1;
	        window.location.hash = hash_page;
	        $("#load_alert").slideUp(500);
	        $('#storets_list_catogory_id').val('');
    		$("#load_content").html('').slideUp(500);
	        load_content();
	    });
	    $(document).on('change', '#storets_list_catogory_id', function () {
	        hash_page = 1;
	        window.location.hash = hash_page;
	        load_content();
	    });

	</script>
@else
<div class="alert alert-group alert-primary alert-dismissible fade show alert-icon" role="alert">
	<div class="alert-group-prepend">
        <span class="alert-group-icon text-">
            <i class="fa fa-times"></i>
        </span>
    </div>
    <div class="alert-content">
        Данная страница доступна только авторизованным пользователям!
    </div>
</div>
@endif
@endsection