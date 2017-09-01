@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Actividades</h1>

	<section class="my-4">
		<h2>Actividades organizadas por mí</h2>

		<div class="mt-4 gallery">
			<ul class="gallery-items">
				@foreach ($organizedActivities as $activity)
					<li class="gallery-item card">
						<a class="gallery-item-link" href="{{ route('admin.activities.show', [$activity]) }}">
							<img class="gallery-item-image card-img-top" src="{{ $activity->imageUrl }}">

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

									<p class="gallery-item-description">
										{{ $activity->description }}
									</p>

									<div class="gallery-item-tags">
										@foreach ($activity->tags as $tag)
											<a class="badge badge-info" href="{{
												route('admin.activities.index', [ 'q' => $tag->name ])
											}}">
												{{ $tag->name }}
											</a>
										@endforeach
									</div>

									@unless ($activity->published)
										<div class="gallery-item-draft-mark">
											<span class="badge badge-warning">
												Borrador
											</span>
										</div>
									@endunless
								</div>
							</div>
						</a>
					</li>
				@endforeach

				<li class="gallery-item card">
					<a class="gallery-item-link gallery-item-link--new{{
						Gate::denies('create', Avem\Activity::class) ? ' disabled' : ''
					   }}" href="{{ route('admin.activities.create') }}">
						<div class="text-center">
							Crear<br>
							<i class="fa fa-2x fa-plus"></i>
						</div>
					</a>
				</li>
			</ul>
		</div>
	</section>

	<section class="my-4">
		<h2>Todas las actividades</h2>

		<form class="w-100 mt-4 input-group">
			<input class="form-control" type="search" name="q"
			       value="{{ old('q', isset($q) ? $q : '') }}"
			       placeholder="Día Mundial de la Salud">
			<span class="input-group-btn">
				<button role="button" class="btn btn-secondary">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>
			</span>
		</form>

		<div class="mt-2 activity-index">
			<ul class="activity-items">
				@foreach ($allActivities as $activity)
					<li class="activity-item">
						<img class="activity-image" src="{{ $activity->imageUrl }}">
						<div class="activity-info">
							<div class="activity-header">
								<h4 class="activity-name">
									{{ $activity->name }}
								</h4>

								@unless ($activity->published)
									<span class="ml-2 badge badge-warning">
										Borrador
									</span>
								@endunless

								<span class="activity-extra">
									@if ($activity->start !== null && $activity->location !== null)
										<i class="fa fa-calendar mr-1"></i>
										{{ $activity->start->formatLocalized('%e de %B del %Y') }}
										en {{ $activity->location }}
									@endif
								</span>
							</div>

							<p class="activity-description">{{ $activity->description }}</p>
							<ul class="activity-tags">
								@foreach ($activity->tags as $tag)
									<li class="activity-tag">
										<a class="badge badge-info" href="{{
											route('admin.activities.index', [ 'q' => $tag->name ])
										}}">
											{{ $tag->name }}
										</a>
									</li>
								@endforeach
							</ul>
						</div>

						<div class="activity-actions">
							<form action="{{ route('admin.activities.publish', [$activity]) }}" method="post">
								{{ csrf_field() }}
								<div class="btn-group">
									<a class="btn btn-secondary{{ Gate::denies('view', $activity) ? ' disabled' : '' }}"
									   role="button" href="{{ route('admin.activities.show', [$activity]) }}">
										<i class="fa fa-cog"></i><span class="ml-1">Administrar</span>
									</a>

									<a class="btn btn-secondary{{ Gate::denies('update', $activity) ? ' disabled' : '' }}"
									   role="button" href="{{ route('admin.activities.edit', [$activity]) }}">
										<i class="fa fa-pencil"></i><span class="ml-1">Editar</span>
									</a>

									@unless ($activity->published)
										<input type="hidden" name="published" value="1">
										<button role="button" type="submit" class="btn btn-primary">
											<i class="fa fa-eye mr-1"></i>Publicar
										</button>
									@else
										<input type="hidden" name="published" value="0">
										<button role="button" type="submit" class="btn btn-secondary">
											<i class="fa fa-eye-slash mr-1"></i>Despublicar
										</button>
									@endunless

									<a class="btn btn-danger{{ Gate::denies('delete', $activity) ? ' disabled' : '' }}"
									   role="button" href="{{ route('admin.activities.delete', [$activity]) }}">
										<i class="fa fa-times"></i><span class="ml-1">Eliminar</span>
									</a>
								</div>
							</form>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
	</section>
@stop
