@extends('admin.board.index')

@push('scripts')
	<script>
		$(function() {
			$("#create-modal").modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="create-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Crea un nuevo de grupo de trabajo</h5>
					<a role="button" class="close" href="{{ route('admin.board') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<form action="{{ route('admin.workingGroups.store') }}" method="post">
					{{ csrf_field() }}
					
					<div class="modal-body">
						<div class="container-fluid">
							@include('admin.workingGroups.form', [
								'workingGroups' => $workingGroups,
							])
						</div>
					</div>

					<div class="modal-footer">
						<a class="btn btn-secondary" role="button" href="{{ route('admin.board') }}">Cancelar</a>
						<button type="submit" class="btn btn-primary" role="button">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop