@extends('admin.activities.modal')

@section('modal-content')
	<div class="container-fluid">
		<div class="mx-3 mt-4 row">
			<div class="col-md-6">
				<img class="w-100" src="{{ $activity->imageUrl }}">
			</div>

			<dl class="col-md-6">
				<dt>Nombre</dt>
				<dd>{{ $activity->name }}</dd>

				<dt>Lugar</dt>
				<dd>
					<i class="fa fa-map-marker mr-1"></i>
					@if ($activity->location !== null)
						{{ $activity->location }}
					@else
						No asignado
					@endif
				</dd>

				<dt>Inicio de la actividad</dt>
				<dd>
					<i class="fa fa-calendar mr-1"></i>
					@if ($activity->start !== null)
						{{ $activity->start->formatLocalized('%d de %B del %Y a las %H:%M') }}
					@else
						No asignado
					@endif
				</dd>

				<dt>Fin de la actividad</dt>
				<dd>
					<i class="fa fa-calendar mr-1"></i>
					@if ($activity->end !== null)
						{{ $activity->end->formatLocalized('%d de %B del %Y a las %H:%M') }}
					@else
						No asignado
					@endif
				</dd>
			</dl>
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
