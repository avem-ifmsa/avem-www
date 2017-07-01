@extends('admin.activities.index')

@push('scripts')
	<script>
		$(function() {
			$('#create-modal').modal();
			$('#create-save-and-publish-button').click(function(event) {
				$('input[name=published]').val(true);
			});
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="create-modal" class="modal fade" role="dialog" data-backdrop="static">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Crea una actividad</h5>
					<a role="button" class="close" href="{{ route('admin.activities.index') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<form method="post" action="{{ route('admin.activities.store') }}">
					<div class="modal-body">
						{{ csrf_field() }}

						<div class="container-fluid">
							@include('admin.activities.form', compact('mbMemberPeriods', 'organizers'))
						</div>

						<input id="create-published" type="hidden" value="0">
					</div>

					<div class="modal-footer">
						<a class="btn btn-secondary" role="button" href="{{ route('admin.activities.index') }}">Cancelar</a>
						<button type="submit" class="btn btn-secondary" role="button">Guardar</button>
						<button id="create-save-and-publish-button" class="btn btn-primary"
						        type="submit" role="button">Guardar y publicar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
