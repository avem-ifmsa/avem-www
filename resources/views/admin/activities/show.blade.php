@extends('admin.activities.modal')

@section('modal-content')
	<div class="container-fluid">
		<div class="mx-3 mt-4 row">
			<div class="col-lg-6">
				<img class="w-100" src="{{ $activity->imageUrl }}">
			</div>

			<div class="col-lg-6 mt-md-3 mt-lg-0">
				@if ($activity->name != null)
					<h4>{{ $activity->name }}</h4>
				@else
					<h4 class="font-italic">No establecido</h4>
				@endif

				<div class="clearfix">
					@if ($activity->start != null)
						<div class="float-left">
							<i class="mr-1 fa fa-calendar"></i>
							{{ $activity->start->formatLocalized('%e %b del %Y') }}
							@if ($activity->end != null && $activity->end->isSameDay($activity->start))
								<span class="ml-2">
									{{ $activity->start->formatLocalized('%H:%M') }}
									- {{ $activity->end->formatLocalized('%H:%M') }}
								</span>
							@elseif ($activity->end != null)
								- {{ $activity->end->formatLocalized('%e %b del %Y') }}
							@endif
						</div>
					@endif

					@if ($activity->location != null)
						<div class="float-right">
							<i class="mr-1 fa fa-map-marker"></i>
							{{ $activity->location }}
						</div>
					@endif
				</div>

				<p class="my-2">
					{{ $activity->description }}
				</p>

				<dl class="row">
					@if ($activity->points != 0)
						<dt class="col-md-4">Puntos:</dt>
						<dd class="col-md-8">{{ $activity->points }}</dd>
					@endif

					@if ($activity->inscription_start && $activity->inscription_end)
						<dt class="col-md-4">Inscripciones:</dt>
						<dd class="col-md-8">
							<div class="text-nowrap">
								{{ $activity->inscription_start->formatLocalized('%e %b del %Y') }}
								- {{ $activity->inscription_end->formatLocalized('%e %b del %Y') }}
							</div>

							@if ($activity->member_limit != null)
								<div class="text-nowrap">
									{{ $activity->member_limit }} plazas disponibles
								</div>
							@endif
						</dd>
					@endif

					<dt class="col-md-4">Responsables:</dt>
					<dd class="col-md-8">
						<ul class="list-unstyled">
							@foreach ($activity->organizerPeriods as $period)
							<li>
								{{ $period->user->fullName }}
							</li>
							@endforeach
						</ul>
					</dd>
				</dl>
			</div>
		</div>
	</div>
@stop

@section('modal-footer')
	<a role="button" href="{{ route('admin.activities.index') }}" class="btn btn-secondary">Cancelar</a>

	<form action="{{ route('admin.activities.publish', [$activity]) }}" method="post">
		{{ csrf_field() }}
		@unless ($activity->published)
			<input type="hidden" name="published" value="1">
			<button role="button" type="submit" class="btn btn-secondary">Publicar</button>
		@else
			<input type="hidden" name="published" value="0">
			<button role="button" type="submit" class="btn btn-secondary">Despublicar</button>
		@endunless
	</form>

	<a role="button" href="{{ route('admin.activities.edit', [$activity]) }}" class="btn btn-primary{{
		Gate::denies('update', $activity) ? ' disabled' : ''
	}}" >Editar</a>
	<a role="button" href="{{ route('admin.activities.delete', [$activity]) }}" class="btn btn-danger{{
		Gate::denies('delete', $activity) ? ' disabled' : ''
	}}">Eliminar</a>
@stop
