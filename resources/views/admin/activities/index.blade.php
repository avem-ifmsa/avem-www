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
							<img class="gallery-item-top card-img-top"
							     src="{{ $activity->getFirstMediaUrl('images') }}">
							<div class="gallery-item-content card-block">
								<h4 class="gallery-item-title card-title">
									{{ $activity->name }}
								</h4>
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

		<form class="w-75 mx-auto mt-4 input-group">
			<input class="form-control" type="search" name="q"
			       placeholder="Día Mundial de la Salud">
			<span class="input-group-btn">
				<button role="button" class="btn btn-secondary">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>
			</span>
		</form>

		<div class="mt-1 activity-index">
			<ul class="activity-entries">
				@foreach ($allActivities as $activity)
					<li class="activity-entry">
						<img class="activity-image" src="{{ $activity->image->getUrl() }}">
						<div class="activity-info">
							<div class="activity-header">
								<h4 class="activity-name">
									{{ $activity->name }}
									@if (!$activity->published)
										<span class="badge badge-warning ml-1">Borrador</span>
									@endif
								</h4>

								<span class="activity-extra">
									@if ($activity->start !== null)
										{{ $activity->start->formatLocalized('%e de %B del %Y') }}
									@endif
									@if ($activity->location !== null)
										en {{ $activity->location }}
									@endif
								</span>
							</div>

							<p class="activity-description">{{ $activity->description }}</p>
							<ul class="activity-tags">
								@foreach ($activity->tags as $tag)
									<li class="activity-tag">{{ $tag->name }}</li>
								@endforeach
							</ul>
						</div>

						<div class="activity-actions">
							<form action="{{ route('admin.activities.destroy', [$activity]) }}" method="post">
								{{ csrf_field() }}
								{{ method_field('delete') }}
								<div class="btn-group">
									<a class="btn btn-secondary{{ Gate::denies('view', $activity) ? ' disabled' : '' }}"
									   role="button" href="{{ route('admin.activities.show', [$activity]) }}">
										<i class="fa fa-cog"></i><span class="ml-1">Administrar</span>
									</a>

									<a class="btn btn-secondary{{ Gate::denies('update', $activity) ? ' disabled' : '' }}"
									   role="button" href="{{ route('admin.activities.edit', [$activity]) }}">
										<i class="fa fa-pencil"></i><span class="ml-1">Editar</span>
									</a>

									<button class="btn btn-danger{{ Gate::denies('delete', $activity) ? ' disabled' : '' }}"
									        role="button" type="submit">
										<i class="fa fa-times"></i><span class="ml-1">Eliminar</span>
									</button>
								</div>
							</form>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
	</section>
@stop
