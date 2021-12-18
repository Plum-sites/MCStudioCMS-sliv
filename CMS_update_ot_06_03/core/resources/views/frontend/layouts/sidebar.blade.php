<div class="pl-3 pr-3">
	<h3 class="text-center">Наши сервера</h3>
	<div class="card mb-2 p-3">
		@foreach($servers as $server)
		<?php
		if(@$server->online > @$server->slots) {
			$server->slots = $server->online+1;
		}
		?>
		<div class="monitoring">
			<div class="graphy">
				<input type="text" class="servers" data-angleoffset="-125" data-anglearc="250" data-width="80" data-height="80" value="{{ @$server->online }}" data-max="{{ @$server->slots }}" readonly disabled>
			</div>
			<div class="inform">
				<div class="servers">
					{{ @$server->name }}
				</div>
				<div class="players">
					@if(@$server->slots == 0)
					Сервер выключен
					@else
					Онлайн: {{ @$server->online }} из {{ @$server->slots }} чел.
					@endif
				</div>
			</div>
			<hr class="floatfix">
		</div>
		@endforeach
		<div class="monitoring" @if($servers->sum('slots') == 0) hidden @endif>
			<div class="row col-md-12 p-0">
				<div class="col-md-7 text-left">
					Игроков всего:
				</div>
				<div class="col-md-5 text-right p-0 m-0">
					{{ @$servers->sum('online') }} из {{ @$servers->sum('slots') }}
				</div>
			</div>
		</div>
	</div>
</div>
