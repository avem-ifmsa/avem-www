@extends('layouts.main')

@push('scripts')
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
@endpush

@section('home-content')
	<section class="card p-4">
		<h3 class="mb-3">Tus actividades</h3>

		@if ($inscribedActivities->isEmpty())
			<div class="my-3 text-center">
				Todavía no te has suscrito a ninguna de nuestras próximas actividades.
			</div>
		@else
			<div class="gallery">
				<ul class="gallery-items">
					@foreach ($inscribedActivities as $activity)
						<li class="gallery-item card">
							<img class="gallery-item-image card-img-top" src="{{ $activity->imageUrl }}">

							<div class="card-block">
								<div class="gallery-item-content">
									<div class="gallery-header card-title">
										<h4 class="gallery-item-title">
											{{ $activity->name }}
										</h4>

										<div class="gallery-item-extra">
											@if ($activity->start !== null)
												<span class="float-left">
													<i class="fa fa-calendar mr-1"></i>
													{{ $activity->start->format('d/m/y') }}
												</span>
											@endif

											@if ($activity->location !== null)
												<span class="float-right">
													<i class="fa fa-map-marker"></i>
													{{ $activity->location }}
												</span>
											@endif
										</div>
									</div>

									<p class="gallery-item-description">
										{{ $activity->description }}
									</p>

									<div class="gallery-item-tags">
										@foreach ($activity->tags as $tag)
											<span class="badge badge-info">
												{{ $tag->name }}
											</span>
										@endforeach
									</div>

									<div class="gallery-item-actions">
										<form action="{{ route('activities.unsubscribe', [$activity]) }}" method="post">
											{{ csrf_field() }}
											<button type="submit" role="button" class="btn btn-block"
												@if ($activity->inscription_policy != 'inscribed')
													disabled data-toggle="tooltip" data-placement="bottom"
													title="No es posible desinscribirse de esta actividad"
												@endif
											>No asistiré</button>
										</form>
									</div>
								</div>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
		@endif
	</section>

	<section class="mt-3 card p-4">
		<h3 class="mb-3">Próximas actividades</h3>

		@if ($upcomingActivities->isEmpty())
			<div class="my-3 text-center">
				Todavía no hay actividades disponibles.
			</div>
		@else
			<div class="gallery">
				<ul class="gallery-items">
					@foreach ($upcomingActivities as $activity)
						<li class="gallery-item card">
							<img class="gallery-item-image card-img-top" src="{{ $activity->imageUrl }}">

							<div class="card-block">
								<div class="gallery-item-content">
									<div class="gallery-header card-title">
										<h4 class="gallery-item-title">
											{{ $activity->name }}
										</h4>

										<div class="gallery-item-extra">
											@if ($activity->start !== null)
												<span class="float-left">
													<i class="fa fa-calendar mr-1"></i>
													{{ $activity->start->format('d/m/y') }}
												</span>
											@endif

											@if ($activity->location !== null)
												<span class="float-right">
													<i class="fa fa-map-marker"></i>
													{{ $activity->location }}
												</span>
											@endif
										</div>
									</div>

									<p class="gallery-item-description">
										{{ $activity->description }}
									</p>

									<div class="gallery-item-tags">
										@foreach ($activity->tags as $tag)
											<span class="badge badge-info">
												{{ $tag->name }}
											</span>
										@endforeach
									</div>
								</div>

								<div class="gallery-item-actions">
									<form action="{{ route('activities.subscribe', [$activity]) }}" method="post">
										{{ csrf_field() }}
										<button type="submit" role="button" class="btn btn-block"
											@if($activity->inscription_policy != 'inscribed')
												disabled data-toggle="tooltip" data-placement="bottom"
												title="No es posible suscribirse a esta actividad"
											@elseif ($activity->member_limit !== null && $activity->member_limit >= $activity->inscribedUsers()->count())
												disabled data-toggle="tooltip" data-placement="bottom"
												title="No quedan plazas para esta actividad"
											@endif
										>Asistiré</button>
									</form>
								</div>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
		@endif
	</section>
@stop

@section('content')
	<div class="container mb-4">
		<div class="row">
			<div class="mb-3 mb-md-0 col-md-4 col-lg-3">
				<div class="card nav nav-pills flex-column">
					<a href="{{ route('home') }}" class="nav-link{{
						Route::currentRouteName() === 'home' ? ' active' : ''
					}}">Entorno de usuario</a>

					<!-- <a href="{{ route('ticket.exchange') }}" class="nav-link{{
						Route::currentRouteName() === 'ticket.exchange' ? ' active' : ''
					}}">Canjear tickets</a> -->

					<a href="{{ route('home.points') }}" class="nav-link{{
						Route::currentRouteName() === 'home.points' ? ' active' : ''
					}}">Desglose de puntos</a>

					<a href="{{ route('home.settings') }}" class="nav-link{{
						Route::currentRouteName() === 'home.settings' ? ' active' : ''
					}}">Ajustes</a>
				</div>
				<iframe src="https://calendar.google.com/calendar/embed?src=im2pquv9sr5j0uenm96dqf2478%40group.calendar.google.com&ctz=Europe%2FMadrid" style="border: 0" width="800" height="600" frameborder="0" scrolling="no">
				</iframe>
			</div>

			<div class="col-md-8 col-lg-9">
				@yield('home-content')
			</div>
		</div>
	</div>
@endsection
