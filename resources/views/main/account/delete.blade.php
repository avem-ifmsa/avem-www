@extends('main.settings')

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
					<h5 class="modal-title">Eliminar cuenta de usuario</h5>
					<a role="button" class="close" href="{{ route('home.settings') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<div class="modal-body">
					<div class="container-fluid">
						<p>
							<strong class="">¡Cuidado!</strong> Esta acción eliminará su cuenta y todos los datos
							relacionados con ella. Perderá todos sus <strong>puntos</strong>, toda información
							sobre las <strong>actividades realizadas</strong>, <strong>intercambios</strong>,
							así como información de <strong>pertenencia a cargos</strong> y <strong>pago de
							cuotas</strong>.
						</p>

						<p>
							Si lo que desea es <strong>dejar de recibir nuestros correos</strong>, solo tiene que
							<a href="{{ route('home.settings').'#correos' }}">desuscribirse de nuestra lista
							de correo</a>. De esta manera, conservará sus datos y podrá volver a suscribirse en
							cualquier momento.
						</p>

						<p>
							¿Está seguro de que quiere eliminar su cuenta de forma permanente?
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
					<form action="{{ route('account.delete.confirm') }}" method="post">
						{{ csrf_field() }}
						<a class="btn btn-secondary" href="{{ route('home.settings') }}" role="button">Cancelar</a>
						<button type="submit" id="delete-button" class="btn btn-danger disabled" role="button">Eliminar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop
