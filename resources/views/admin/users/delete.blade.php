@extends('admin.users.index')

@push('scripts')
	<script>
		$(function() {
			$('#delete-modal').modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="delete-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Eliminar usuario</h5>
					<a role="button" class="close" href="{{ route('admin.users.index') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<div class="modal-body">
					<div class="container-fluid">
						<p>
							Se va a eliminar la información del usuario <strong>{{ $user->fullName }}</strong>. Al hacerlo,
							se perderán todos sus datos personales, incluida su participación en actividades.
						</p>

						<p>
							Esta acción no puede deshacerse. Si todavía quieres hacerlo,
							escribe en mayúsculas la palabra «ELIMINAR» en el siguiente recuadro:
						</p>

						<p class="form-inline justify-content-center">
							<label class="form-label" for="delete-confirm">
								<strong>Confirmar acción:</strong>
							</label>
							<input is="input-confirm" type="text" id="delete-confirm" placeholder="ELIMINAR"
							       class="ml-2 form-control" confirm="ELIMINAR" target="#delete-button">
						</p>
					</div>
				</div>

				<div class="modal-footer">
					<form action="{{ route('admin.users.destroy', [$user]) }}" method="post">
						{{ csrf_field() }}
						{{ method_field('delete') }}
						<a class="btn btn-secondary" href="{{ route('admin.users.index') }}" role="button">Cancelar</a>
						<button type="submit" id="delete-button" class="btn btn-danger disabled" role="button">Eliminar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop
