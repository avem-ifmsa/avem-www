@extends('admin.activities.index')

@push('scripts')
	<script>
		$(function() {
			$('#expire-modal').modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="expire-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Expirar tickets de actividad</h5>
					<a role="button" class="close" href="{{ route('admin.activities.tickets.index', [$activity]) }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<div class="modal-body">
					<div class="container-fluid">
						<p>
							Se van a expirar los tickets de la actividad <strong>«{{ $activity->name }}»</strong>.
							Al hacerlo, quedarán invalidados todos los tickets que todavía no hayan sido canjeados.
							Esta acción <strong>no tendrá ningún efecto sobre los tickets que ya hayan sido canjeados.</strong>
						</p>

						<p>
							Esta acción no puede deshacerse. Si todavía quieres hacerlo,
							escribe en mayúsculas la palabra «CADUCAR» en el siguiente recuadro:
						</p>

						<p class="form-inline justify-content-center">
							<label class="form-label" for="remove-confirm">
								<strong>Confirmar acción:</strong>
							</label>
							<input is="input-confirm" type="text" id="expire-confirm" placeholder="CADUCAR"
							       class="ml-2 form-control" confirm="CADUCAR" target="#expire-button">
						</p>
					</div>
				</div>

				<div class="modal-footer">
					<a class="btn btn-secondary" href="{{ route('admin.activities.tickets.index', [$activity]) }}" role="button">Cancelar</a>
					<form action="{{ route('admin.activities.tickets.expire', [$activity, $activityTickets->first()]) }}" method="post">
						{{ csrf_field() }}
						<button type="submit" id="expire-button" class="btn btn-danger disabled" role="button">Expirar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop
