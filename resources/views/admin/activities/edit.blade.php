@extends('admin.activities.index')

@push('scripts')
	<script>
		var editActivityForm, activityDraftAlert, publishUnpublishButton;

		function isActivityReadyToPublish()
		{
			const activityHasImage = {{ $activity->image ? 'true' : 'false' }};
			return editActivityForm[0].checkValidity()
			    && (activityHasImage || $('input[name=image]').val() !== '');
		}

		function checkActivityDraftValidity() {
			@if (!$activity->published)
				const isDraftValid = isActivityReadyToPublish();
				publishUnpublishButton.prop('disabled', !isDraftValid);
				activityDraftAlert.collapse(isDraftValid ? 'hide' : 'show');
			@endif
		}

		function toggleActivityDraftStatus() {
			$('input[name=published]').val({{
				$activity->published ? '0' : '1'
			}});
		}

		$(function() {
			editActivityForm = $('#edit-activity-form');
			activityDraftAlert = $('#edit-draft-alert');
			publishUnpublishButton = $('#edit-publish-unpublish-btn');

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
					<h5 class="modal-title">Edita la actividad</h5>
					<a role="button" class="close" href="{{ route('admin.activities.index') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<form id="edit-activity-form" action="{{ route('admin.activities.update', [$activity]) }}"
				      method="post" enctype="multipart/form-data" oninput="checkActivityDraftValidity()"
				      onchange="checkActivityDraftValidity()" {{ $activity->published ? '' : 'novalidate' }}>
					{{ csrf_field() }}
					{{ method_field('patch') }}

					<div class="modal-body">
						<div class="container-fluid">
							@if (!$activity->published)
								<div class="alert alert-warning collapse{{ $activity->isReadyToPublish ? '' : ' show' }}">
									Esta actividad se encuentra en estado de borrador y aún no está lista para
									ser publicada. Acuérdate de rellenar los campos que faltan antes de publicarla.
								</div>
							@endif

							@include('admin.activities.form', compact('activity', 'organizerPeriods', 'chargePeriods'))
						</div>
					</div>

					<div class="modal-footer">
						<a class="btn btn-secondary" role="button" href="{{ route('admin.activities.index') }}">Cancelar</a>
						<button id="edit-publish-unpublish-btn" type="submit" class="btn btn-secondary"
						        role="button" onclick="toggleActivityDraftStatus()">
							{{ $activity->published ? 'Despublicar' : 'Publicar' }}
						</button>
						<button type="submit" class="btn btn-primary" role="button">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
