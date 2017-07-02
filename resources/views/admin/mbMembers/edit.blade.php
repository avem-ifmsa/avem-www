@extends('admin.mbMembers.index')

@push('scripts')
	<script>
		$(function() {
			$('#create-modal').modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="create-modal" class="modal fade" role="dialog" data-backdrop="static">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Edita el perfil de miembro de junta</h5>
					<a role="button" class="close" href="{{ route('admin.mbMembers.index') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<form method="post" action="{{ route('admin.mbMembers.update', [$mbMember]) }}">
					{{ csrf_field() }}
					{{ method_field('patch') }}

					<div class="modal-body">	
						<div class="container-fluid">
							@include('admin.mbMembers.form', compact('mbMember', 'users'))
						</div>
					</div>
						
					<div class="modal-footer">
						<a class="btn btn-secondary" role="button" href="{{ route('admin.mbMembers.index') }}">Cancelar</a>
						<button type="submit" class="btn btn-primary" role="button">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop