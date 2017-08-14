@extends('admin.users.index')

@push('scripts')
	<script>
		$(function() {
			$('#create-modal').modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="create-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
			<form action="{{ route('admin.users.transactions.store', [$user]) }}" method="post">
				{{ csrf_field() }}

				<div class="modal-content">
					<header class="modal-header">
						<h5 class="modal-title">Crear transacción</h5>
						<a role="button" class="close" href="{{ route('admin.users.transactions.index', $user) }}" aria-label="Cerrar">
							<span aria-hidden="true">&times;</span>
						</a>
					</header>

					<div class="modal-body">
						<div class="container-fluid">
							@include('admin.users.transactions.form', compact('user', 'issuerPeriod'))
						</div>
					</div>

					<div class="modal-footer">
						<a role="button" class="btn btn-secondary" href="{{ route('admin.users.transactions.index', [$user]) }}">
							Cancelar
						</a>
						<button type="submit" role="button" class="btn btn-primary">
							Guardar
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@stop
