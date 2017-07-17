@extends('admin.board.index')

@push('scripts')
	<script>
		$(function() {
			$("#edit-modal").modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="edit-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Edita un cargo</h5>
					<a role="button" class="close" href="{{ route('admin.board') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<form action="{{ route('admin.charges.update', [$charge]) }}" method="post">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					
					<div class="modal-body">
						<div class="container-fluid">
							<div class="alert alert-info alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
									<span aria-hidden="true">&times;</span>
								</button>
								
								<strong>¡Psst!</strong> Si lo que quieres es asignar este cargo a un usuario,
								<a href="{{ route('admin.charges.assign', [$charge]) }}">hazlo aquí</a>.
							</div>
							
							@include('admin.charges.form', [
								'charge'        => $charge,
								'workingGroups' => $workingGroups,
							])
						</div>
					</div>

					<div class="modal-footer">
						<a class="btn btn-secondary" role="button" href="#">Cancelar</a>
						<button type="submit" class="btn btn-primary" role="button">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop