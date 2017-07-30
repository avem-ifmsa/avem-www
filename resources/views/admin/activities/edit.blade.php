@extends('admin.activities.index')

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
					<h5 class="modal-title">Edita la actividad</h5>
					<a role="button" class="close" href="{{ route('admin.activities.index') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<form action="{{ route('admin.activities.update', [$activity]) }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{ method_field('patch') }}

					<div class="modal-body">
						<div class="container-fluid">
							@include('admin.activities.form', compact('activity', 'mbMemberPeriods', 'organizers'))
						</div>
					</div>

					<div class="modal-footer">
						<a class="btn btn-secondary" role="button" href="{{ route('admin.activities.index') }}">Cancelar</a>
						<button type="submit" class="btn btn-primary" role="button">Guardar</button>

						@if ($activity->published)
							<form action="{{ route('admin.activities.publish', [$activity]) }}" method="post">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-secondary" role="button">Publicar</button>
							</form>
						@else
							<form action="{{ route('admin.activities.unpublish', [$activity]) }}" method="post">
								{{ csrf_field()}}
								<button type="submit" class="btn btn-secondary" role="button">Despublicar</button>
							</form>
						@endif
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
