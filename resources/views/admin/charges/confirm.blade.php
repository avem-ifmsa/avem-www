@extends('admin.board.index')

@push('scripts')
	<script>
		$(function() {
			$('#assign-modal').modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="assign-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Confirmar asignación de cargo&hellip;</h5>
					<a role="button" class="close" href="{{ route('admin.board') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<form action="{{ route('admin.chargePeriods.store') }}" method="post">
					{{ csrf_field() }}

					<input type="hidden" name="user"   value={{ $user->id }}>
					<input type="hidden" name="charge" value="{{ $charge->id }}">
					<input type="hidden" name="start"  value="{{ $chargePeriodStart }}">

					<div class="modal-body">
						<div class="container-fluid">
							<p class="h6">Se va a asignar el cargo {{ $charge->name }} a:</p>

							<div class="my-4">
								<div class="user-entry user-entry--large text-center">
									<img class="user-image" src="{{ $user->profileImageUrl }}">
									<span class="user-info">
										<span class="user-name">{{ $user->fullName }}</span>
										<span class="user-email">{{ $user->email }}</span>
									</span>
								</div>
							</div>

							<p class="form-group">
								<label for="confirm-end" class="h6">Asignar cargo hasta&hellip;</label>
								<select id="confirm-end" class="my-1 form-control" name="end" required>
									<option value="{{ $upcomingPeriodEnd }}">Finalizar el año que viene</option>
									<option value="{{ $currentPeriodEnd  }}">Finalizar el periodo actual</option>
								</select>
							</p>
						</div>
					</div>

					<div class="modal-footer">
						<a class="btn btn-secondary" href="{{ route('admin.board') }}">Cancelar</a>
						<button type="submit" class="btn btn-primary" role="button">Confirmar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
