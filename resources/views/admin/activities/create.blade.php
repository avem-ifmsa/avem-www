@extends('admin.activities.index')

@push('scripts')
	<script>
		var createActivityForm, activityDraftAlert, saveAndPublishButton;

		function isActivityReadyToPublish()
		{
			return createActivityForm[0].checkValidity()
			    && $('input[name=image]').val() !== '';
		}

		function onSaveAndPublishActivity() {
			$('input[name=published]').val(true);
		}

		function checkActivityDraftValidity() {
			const isDraftValid = isActivityReadyToPublish();
			activityDraftAlert.collapse(isDraftValid ? 'hide' : 'show');
			saveAndPublishButton.prop('disabled', !isDraftValid);
		}

		$(function() {
			activityDraftAlert = $('#create-draft-alert');
			createActivityForm = $('#create-activity-form');
			saveAndPublishButton = $('#create-save-and-publish-btn');

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

				<form id="create-activity-form" method="post" action="{{ route('admin.activities.store') }}"
				      enctype="multipart/form-data" oninput="checkActivityDraftValidity()"
				      onchange="checkActivityDraftValidity()" novalidate>
					{{ csrf_field() }}

					<div class="modal-body">
						<div class="container-fluid">
							<div id="create-draft-alert" class="alert alert-warning collapse show">
								Esta actividad todavía tiene campos por rellenar y por ello no puede ser publicada.
								Acuérdate de completar los campos que faltan antes de publicarla.
							</div>

							@include('admin.activities.form', compact('mbMemberPeriods', 'organizers'))
						</div>
					</div>

					<div class="modal-footer">
						<a class="btn btn-secondary" role="button" href="{{ route('admin.activities.index') }}">Cancelar</a>
						<button type="submit" class="btn btn-secondary" role="button">Guardar como borrador</button>
						<button id="create-save-and-publish-btn" type="submit" class="btn btn-primary" role="button"
						        onclick="onSaveAndPublishActivity()" disabled>Guardar y publicar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
