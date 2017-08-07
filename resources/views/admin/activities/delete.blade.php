@extends('admin.activities.index')

@push('scripts')
	<script>
		$(function() {
			$('#remove-modal').modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="remove-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Eliminar actividad</h5>
					<a role="button" class="close" href="{{ route('admin.activities.index') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<div class="modal-body">
					<div class="container-fluid">
						<p>
							Se va a eliminar la actividad <strong>«{{ $activity->name }}»</strong>. Al hacerlo,
							desaparecerá toda la información asociada a la actividad, incluidas la lista de organizadores,
							asistentes, tickets, <strong>así como los puntos asociados a dicha actividad.</strong>
						</p>

						<p>
							Esta acción no puede deshacerse. Si todavía quieres hacerlo,
							escribe en mayúsculas la palabra «ELIMINAR» en el siguiente recuadro:
						</p>

						<p class="form-inline justify-content-center">
							<label class="form-label" for="remove-confirm">
								<strong>Confirmar acción:</strong>
							</label>
							<input is="input-confirm" type="text" id="remove-confirm" placeholder="ELIMINAR"
							       class="ml-2 form-control" confirm="ELIMINAR" target="#remove-button">
						</p>
					</div>
				</div>

				<div class="modal-footer">
					<form action="{{ route('admin.activities.destroy', [$activity]) }}" method="post">
						{{ csrf_field() }}
						{{ method_field('delete') }}

						<a class="btn btn-secondary" href="{{ route('admin.activities.index') }}" role="button">Cancelar</a>
						<button type="submit" id="remove-button" class="btn btn-danger disabled" role="button">Eliminar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop
