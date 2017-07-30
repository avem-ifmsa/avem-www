@extends('admin.activities.index')

@push('scripts')
	<script>
		function onSaveAndPublishActivity() {
			$('input[name=published]').val(true);
			$('#create-form').submit();
		}

		$(function() {
			$('#create-modal').modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="create-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Crea una actividad</h5>
					<a role="button" class="close" href="{{ route('admin.activities.index') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<form id="create-form" method="post" action="{{ route('admin.activities.store') }}">
					{{ csrf_field() }}

					<div class="modal-body">
						<div class="container-fluid">
							@include('admin.activities.form', compact('mbMemberPeriods', 'organizers'))
							<input id="create-published" type="hidden" value="0">
						</div>
					</div>

					<div class="modal-footer">
						<a class="btn btn-secondary" role="button" href="{{ route('admin.activities.index') }}">Cancelar</a>
						<button type="submit" class="btn btn-secondary" role="button">Guardar como borrador</button>
						<button type="button" class="btn btn-primary" role="button" onclick="onSaveAndPublishActivity">Guardar y publicar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
