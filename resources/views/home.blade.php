@extends('layouts.main')

@section('home-content')
	<section>
		<h2>Tus actividades</h2>

		@if ($inscribedActivities->isEmpty())
			<div class="my-3 text-center">
				Todavía no te has suscrito a ninguna de nuestras próximas actividades.
			</div>
		@else
			<div class="gallery">
				<ul class="gallery-items">
					@foreach ($inscribedActivities as $activity)
						<li class="gallery-item card">
							<img class="gallery-item-top card-img-top" src="{{ $activity->imageUrl }}">

							<div class="gallery-item-content card-block">
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
										<button type="submit" role="button" class="btn btn-block">
											No asistiré
										</button>
									</form>
								</div>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
		@endif
	</section>

	<section>
		<h2>Próximas actividades</h2>

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
										<button type="submit" role="button" class="btn btn-block">
											Asistiré
										</button>
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
	<div class="row">
		<div class="my-3 my-md-0 col-md-4 col-lg-3">
			<div class="nav nav-pills flex-column">
				<a href="{{ route('home') }}" class="nav-link{{
					Route::currentRouteName() === 'home' ? ' active' : ''
				}}">Entorno de usuario</a>

				<a href="{{ route('ticket') }}" class="nav-link{{
					Route::currentRouteName() === 'ticket' ? ' active' : ''
				}}">Canjear tickets</a>

				<a href="{{ route('points') }}" class="nav-link{{
					Route::currentRouteName() === 'points' ? ' active' : ''
				}}">Desglose de puntos</a>

				<a href="{{ route('settings') }}" class="nav-link{{
					Route::currentRouteName() === 'settings' ? ' active' : ''
				}}">Ajustes</a>
			</div>
		</div>

		<div class="col-md-8 col-lg-9">
			@yield('home-content')
		</div>
	</div>
@endsection
