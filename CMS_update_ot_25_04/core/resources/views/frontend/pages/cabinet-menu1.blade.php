<div class="row">
	<div class="col-md-4">
		<div class="p-4" style="border: 1px solid #eff2f7;border-radius:.375rem;">
			<div id="skin-data-mouse jus" style="vertical-align:top;">
				<style class="skin-viewer-css" type="text/css">
					.skin-viewer *{ background-image: url('{{ @$file_skin }}'); }
					.skin-viewer .cape{ background-image: url('{{ @$file_cloak }}'); }
				</style>
				<div class="skin-viewer mc-skin-viewer-9x legacy legacy-cape spin waving" style="margin-bottom:15px;margin-top:50px;">
		            <div class="player">
		                <div class="head">
		                    <div class="top"></div>
		                    <div class="left"></div>
		                    <div class="front"></div>
		                    <div class="right"></div>
		                    <div class="back"></div>
		                    <div class="bottom"></div>
		                    <div class="accessory">
		                        <div class="top"></div>
		                        <div class="left"></div>
		                        <div class="front"></div>
		                        <div class="right"></div>
		                        <div class="back"></div>
		                        <div class="bottom"></div>
		                    </div>
		                </div>
		                <div class="body">
		                    <div class="top"></div>
		                    <div class="left"></div>
		                    <div class="front"></div>
		                    <div class="right"></div>
		                    <div class="back"></div>
		                    <div class="bottom"></div>
		                    <div class="accessory">
		                        <div class="top"></div>
		                        <div class="left"></div>
		                        <div class="front"></div>
		                        <div class="right"></div>
		                        <div class="back"></div>
		                        <div class="bottom"></div>
		                    </div>
		                </div>
		                <div class="left-arm">
		                    <div class="top"></div>
		                    <div class="left"></div>
		                    <div class="front"></div>
		                    <div class="right"></div>
		                    <div class="back"></div>
		                    <div class="bottom"></div>
		                    <div class="accessory">
		                        <div class="top"></div>
		                        <div class="left"></div>
		                        <div class="front"></div>
		                        <div class="right"></div>
		                        <div class="back"></div>
		                        <div class="bottom"></div>
		                    </div>
		                </div>
		                <div class="right-arm">
		                    <div class="top"></div>
		                    <div class="left"></div>
		                    <div class="front"></div>
		                    <div class="right"></div>
		                    <div class="back"></div>
		                    <div class="bottom"></div>
		                    <div class="accessory">
		                        <div class="top"></div>
		                        <div class="left"></div>
		                        <div class="front"></div>
		                        <div class="right"></div>
		                        <div class="back"></div>
		                        <div class="bottom"></div>
		                    </div>
		                </div>
		                <div class="left-leg">
		                    <div class="top"></div>
		                    <div class="left"></div>
		                    <div class="front"></div>
		                    <div class="right"></div>
		                    <div class="back"></div>
		                    <div class="bottom"></div>
		                    <div class="accessory">
		                        <div class="top"></div>
		                        <div class="left"></div>
		                        <div class="front"></div>
		                        <div class="right"></div>
		                        <div class="back"></div>
		                        <div class="bottom"></div>
		                    </div>
		                </div>
		                <div class="right-leg">
		                    <div class="top"></div>
		                    <div class="left"></div>
		                    <div class="front"></div>
		                    <div class="right"></div>
		                    <div class="back"></div>
		                    <div class="bottom"></div>
		                    <div class="accessory">
		                        <div class="top"></div>
		                        <div class="left"></div>
		                        <div class="front"></div>
		                        <div class="right"></div>
		                        <div class="back"></div>
		                        <div class="bottom"></div>
		                    </div>
		                </div>
		                <div class="cape">
		                    <div class="top"></div>
		                    <div class="left"></div>
		                    <div class="front"></div>
		                    <div class="right"></div>
		                    <div class="back"></div>
		                    <div class="bottom"></div>
		                </div>
		            </div>
		        </div>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="form-group mb-2">
			<form id="form_skin" action="#" role="form" method="post">
				@csrf
				<div class="custom-file">
					<input type="file" class="custom-file-input form-control-sm" id="change_skins" required>
					<label class="custom-file-label col-form-label-sm" style="cursor:pointer;z-index:9999;" for="change_skins">Выбрать скин с компьютера</label>
				</div>
			</form>
		</div>
		<div class="alert alert-group alert-outline-secondary fade show alert-icon mt-2" role="alert">
		    <div class="alert-content w-100">
		        <b>
		        	Возможности установки скина:
		        </b>
		        <hr style="border-top-color:#eff2f7;margin:.775rem 0 .775rem 0;">
		        @if(@$install_skin)
		        <span class="badge badge-primary badge-pill w-100 mb-1 text-left d-block" style="cursor:help;" data-toggle="tooltip" data-html="true" data-placement="top" title="Только 64x32">
				    <i class="fa fa-check-circle"></i> Возможность устанавливать HQ скин [64x32]: Есть
				</span>
				@else
				<span class="badge badge-warning badge-pill w-100 mb-1 text-left d-block" style="cursor:help;" data-toggle="tooltip" data-html="true" data-placement="bottom" title="Только 64x32">
				    <i class="fa fa-times-circle"></i> Возможность устанавливать HQ скин [64x32]: Нет
				</span>
				@endif
				@if(@$install_skin_hd)
		        <span class="badge badge-primary badge-pill w-100 mb-1 text-left d-block" style="cursor:help;" data-toggle="tooltip" data-html="true" data-placement="bottom" title="От 64x32 до 1024x512">
				    <i class="fa fa-check-circle"></i> Возможность устанавливать HD скин [до 1024x512]: Есть
				</span>
				@else
				<span class="badge badge-warning badge-pill w-100 mb-1 text-left d-block" style="cursor:help;" data-toggle="tooltip" data-html="true" data-placement="bottom" title="От 64x32 до 1024x512">
				    <i class="fa fa-times-circle"></i> Возможность устанавливать HD скин [до 1024x512]: Нет
				</span>
				@endif
		    </div>
		</div>
		<hr style="margin:.375rem 0 .775rem 0;">
		<div class="form-group mb-2">
			<form id="form_cloak" action="#" role="form" method="post">
				@csrf
				<div class="custom-file">
					<input type="file" class="custom-file-input form-control-sm" id="change_cloaks" required>
					<label class="custom-file-label col-form-label-sm" style="cursor:pointer;z-index:9999;" for="change_cloaks">Выбрать плащ с компьютера</label>
				</div>
			</form>
		</div>
		<div class="alert alert-group alert-outline-secondary fade show alert-icon mt-2" role="alert">
		    <div class="alert-content w-100">
		        <b>
		        	Возможности установки плаща:
		        </b>
		        <hr style="border-top-color:#eff2f7;margin:.375rem 0 .775rem 0;">
				@if(@$install_cloak)
		        <span class="badge badge-primary badge-pill w-100 mb-1 text-left d-block" style="cursor:help;" data-toggle="tooltip" data-html="true" data-placement="top" title="Только 64x32">
				    <i class="fa fa-check-circle"></i> Возможность устанавливать HQ плащ [64x32]: Есть
				</span>
				@else
				<span class="badge badge-warning badge-pill w-100 mb-1 text-left d-block" style="cursor:help;" data-toggle="tooltip" data-html="true" data-placement="top" title="Только 64x32">
				    <i class="fa fa-times-circle"></i> Возможность устанавливать HQ плащ [64x32]: Нет
				</span>
				@endif
				@if(@$install_cloak_hd)
		        <span class="badge badge-primary badge-pill w-100 mb-1 text-left d-block" style="cursor:help;" data-toggle="tooltip" data-html="true" data-placement="bottom" title="От 64x32 до 512x256">
				    <i class="fa fa-check-circle"></i> Возможность устанавливать HD плащ [до 512x256]: Есть
				</span>
				@else
				<span class="badge badge-warning badge-pill w-100 mb-1 text-left d-block" style="cursor:help;" data-toggle="tooltip" data-html="true" data-placement="bottom" title="От 64x32 до 512x256">
				    <i class="fa fa-times-circle"></i> Возможность устанавливать HD плащ [до 512x256]: Нет
				</span>
				@endif
		    </div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#change_skins').on('change', function() {
		var file = $(this).prop('files')[0];
		$(this).attr('disabled', true);
		$('#change_cloaks').attr('disabled', true);
		$('[for="change_skins"]').html('<i class="fa fa-circle-notch fa-spin"></i> Загрузка скина ' + file.name);
		var form = $('#form_skin')[0];
		var form_data = new FormData(form);
		form_data.append('image', file);
		$.ajax({
		    type: "POST",
		    url: "{{ route('cabinet.upload.skin') }}",
		    data: form_data,
		    contentType: false,
		    processData: false,
		    success: function(data) {
		    	notify(data.message, 8000, data.type);
		    	$('#change_skins').attr('disabled', false).val('');
		    	$('#change_cloaks').attr('disabled', false);
		    	$('[for="change_skins"]').html('Выбрать скин с компьютера');
		    	if(data.type == "info") {
		    		var file_skin = data.file.skin;
			    	var file_cloak = data.file.cloak;
			        $(".skin-viewer-css").html(".skin-viewer *{ background-image: url('" + file_skin + "'); } .skin-viewer .cape { background-image: url('" + file_cloak + "'); }");
		    	}
		    },
		    error: function(data) {
		        console.log(data);
		        $('#change_skins').attr('disabled', false).val('');
		        $('#change_cloaks').attr('disabled', false);
		        $('[for="change_skins"]').html('Выбрать скин с компьютера');
		    }
		});
	});
	$('#change_cloaks').on('change', function() {
		var file = $(this).prop('files')[0];
		$(this).attr('disabled', true);
		$('#change_skins').attr('disabled', true);
		$('[for="change_cloaks"]').html('<i class="fa fa-circle-notch fa-spin"></i> Загрузка плаща ' + file.name);
		var form = $('#form_cloak')[0];
		var form_data = new FormData(form);
		form_data.append('image', file);
		$.ajax({
		    type: "POST",
		    url: "{{ route('cabinet.upload.cloak') }}",
		    data: form_data,
		    contentType: false,
		    processData: false,
		    success: function(data) {
		    	notify(data.message, 8000, data.type);
		    	$('#change_cloaks').attr('disabled', false).val('');
		    	$('#change_skins').attr('disabled', false);
		    	$('[for="change_cloaks"]').html('Выбрать плащ с компьютера');
		    	if(data.type == "info") {
			    	var file_skin = data.file.skin;
			    	var file_cloak = data.file.cloak;
			        $(".skin-viewer-css").html(".skin-viewer *{ background-image: url('" + file_skin + "'); } .skin-viewer .cape { background-image: url('" + file_cloak + "'); }");
	    		}
		    },
		    error: function(data) {
		        console.log(data);
		        $('#change_cloaks').attr('disabled', false).val('');
		        $('#change_skins').attr('disabled', false);
		        $('[for="change_cloaks"]').html('Выбрать плащ с компьютера');
		    }
		});
	});
</script>