@extends('admin.users.index')

@push('scripts')
	<script>
		$(function() {
			$('#edit-modal').modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="edit-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Editar información de usuario</h5>
					<a role="button" class="close" href="{{ route('admin.users.index') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<form action="{{ route('admin.users.update', [$user]) }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{ method_field('patch') }}

					<div class="modal-body">
						<div class="container-fluid">
							@include('admin.users.form', compact('user'))
						</div>
					</div>

					<div class="modal-footer">
						<a class="btn btn-secondary" role="button" href="{{ route('admin.users.index') }}">Cancelar</a>
						<button type="submit" class="btn btn-primary" role="button">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
