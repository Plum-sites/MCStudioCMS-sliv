@if(count(@$ratings_list) >= 1)
<div class="table-responsive mt-3">
	<table class="table table-lg table-expand w-100">
		<thead>
			<tr>
	            <th style="max-width:20px;">
	            	<i class="fas fa-sort-numeric-up" style="font-size:13px;"></i>
	            </th>
	            <th style="min-width:50px;">ИГРОК</th>
	            <th style="min-width:120px;">ГОЛОСОВ</th>
	            <th style="min-width:120px;">ПОСЛЕДНИЙ ГОЛОС</th>
	        </tr>
        </thead>
        <tbody>
			@foreach(@$ratings_list as $key => $rating)
			@php
			$key++;
			$tr_color = '#fff';
			if(@$key == 1) {
				$tr_color = '#fa717208';
			} elseif(@$key == 2) {
				$tr_color = '#008aff08';
			} elseif(@$key == 3) {
				$tr_color = '#91c6e00a';
			}
			@endphp
			<tr class="wow pulse" data-wow-delay="0.3s">
				<td>
					<span class="rating-num">
						<span class="rating-num-{{ @$key }}">
							{{ @$key }}
						</span>
					</span>
				</td>
				<td>
					<span>
						{{ @$rating->user->username }}
					</span>
				</td>
				<td>
					<span>
						{{ @App\Http\Controllers\ToolsController::getPhrase(@$rating->votes, array('голос', 'голоса', 'голосов')) }}
					</span>
				</td>
				<td>
					<span>
						{{ @$rating->updated_at->format('d.m.Y в H:i') }}
					</span>
				</td>
			</tr>
		</tbody>
		@endforeach
	</table>
</div>
@endif