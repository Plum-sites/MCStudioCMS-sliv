@extends('frontend.layouts.master-alternate')
@section('page_title', 'Новости проекта')
@section('body')
<div class="row">
	@if(isset($news_list['error']))
			<div class="card shadow-lg border-0" style="max-width: 100%;">
				<div class="card-body px-5 py-5 text-center text-md-left">
					<div class="row align-items-center">
						<div class="col-md-12">
							<p class="mb-0">
								Произошла ошибка при обновлении новостей. Код: {{ $news_list['error']['error_code'] }}
							</p>
						</div>
					</div>
				</div>
			</div>
	@else
		@if(isset($news_list))
			@foreach(@$news_list as $key => $value)
				<div class="col-md-6 animated fadeIn">
					<div class="card hover-translate-y-n3 hover-shadow-lg overflow-hidden">
						<div class="position-relative overflow-hidden">
							<a href="#" class="d-block">
								<img alt="Image placeholder" src="{{ (empty(@$value['attachments'][0]['photo']['sizes'][4]['url'])) ? asset('assets').'/default.jpg' : @$value['attachments'][0]['photo']['sizes'][4]['url'] }}" class="card-img-top">
							</a>
						</div>
						<div class="card-body py-4">
							<small class="d-block text-sm mb-2 lh-150">{{ date("d.m.Y H:i", @$value['date']) }}</small>
							<p class="mt-3 mb-0">{{ mb_strimwidth(@$value['text'], 0, 140, "...") }}</p>
						</div>
						<div class="card-footer border-0 delimiter-top">
							<div class="row align-items-center">
								<div class="col text-left">
									<div class="actions">
										<a href="#" class="action-item"><i class="fas fa-heart"></i> {{ (!@$value['likes']['count']) ? '0' : @$value['likes']['count'] }}</a>
										<a href="#" class="action-item"><i class="fas fa-eye"></i> {{ (!@$value['views']['count']) ? '0' : @$value['views']['count'] }}</a>
									</div>
								</div>
								<div class="col-auto">
									<a href="https://vk.com/public{{ @$general->vk_group_id }}?w=wall-{{ str_replace('-', '', @$value['owner_id']).'_'.@$value['id'] }}" target="_blank" class="btn btn-sm btn-primary" style="">Подробнее <i class="fas fa-arrow-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		@else
		<div class="card shadow-lg border-0" style="max-width: 100%;">
			<div class="card-body px-5 py-5 text-center text-md-left">
				<div class="row align-items-center">
					<div class="col-md-12">
						<p class="mb-0">
							Новостей пока нет, но Вы держитесь 😉
						</p>
					</div>
				</div>
			</div>
		</div>
		@endif
	@endif

</div>
@if(@$vk_response->type && @$vk_response->message)
<script type="text/javascript">
	$(document).ready(function() {
		var vk_bind_btn = '{{ @$vk_response->hide }}';
		if(vk_bind_btn) {
			$('#vk_bind_btn').slideUp(100);
		}
		notify('{{ @$vk_response->message }}', 8000, '{{ @$vk_response->type }}');
	});
</script>
@endif

@endsection