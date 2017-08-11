@extends('admin.activities.index')

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
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Crear tickets de actividad</h5>
					<a role="button" class="close" href="{{ route('admin.activities.tickets.index', [$activity]) }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<form action="{{ route('admin.activities.tickets.store', [$activity]) }}" method="post">
					{{ csrf_field() }}

					<div class="modal-body">
						<div class="container-fluid">
							<p class="form-inline">
								<label>
									Se generarán <input name="count" class="mx-2 form-control form-control-sm" type="number" min="0" max="300" value="{{ old('count', 50) }}"> tickets.
								</label>
							</p>

							<p class="form-group">
								<label for="create-expires-at">Los tickets caducarán en&hellip;</label>
								<select name="expires_at" id="create-expires-at" class="form-control">
									@if ($activity->end !== null)
										<option value="{{ $activity->end->copy()->addWeeks(2)  }}">Dos semanas después de la actividad</option>
										<option value="{{ $activity->end->copy()->addMonth()   }}">Un mes después la actividad</option>
										<option value="{{ $activity->end->copy()->addMonths(3) }}">Tres meses después de la actividad</option>
									@else
										<option value="{{ Carbon\Carbon::now()->addWeeks(2)  }}">Dentro de dos semanas</option>
										<option value="{{ Carbon\Carbon::now()->addMonths(1) }}">Dentro de un mes</option>
										<option value="{{ Carbon\Carbon::now()->addMonths(3) }}">Dentro de tres meses</option>
									@endif
								</select>
							</p>
						</div>
					</div>

					<div class="modal-footer">
						<a class="btn btn-secondary" role="button" href="{{ route('admin.activities.tickets.index', [$activity]) }}">
							Cancelar
						</a>

						<button type="submit" class="btn btn-primary" role="button">Generar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
