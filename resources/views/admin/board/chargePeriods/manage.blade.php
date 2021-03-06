@extends('admin.board.index')

@push('scripts')
	<script>
		$(function() {
			$("#manage-modal").modal();

			$("#manage-extend-button").click(function() {
				$("#manage-extend-form").submit();
			});

			$("#manage-finish-button").click(function() {
				$("#manage-finish-form").submit();
			});
		});
	</script>
@endpush

@section('content')
	@parent

	<form id="manage-extend-form" action="{{ route('admin.chargePeriods.extend', [$chargePeriod]) }}" method="post">
		{{ csrf_field() }}
	</form>

	<form id="manage-finish-form" action="{{ route('admin.chargePeriods.finish', [$chargePeriod]) }}" method="post">
		{{ csrf_field() }}
	</form>

	<div id="manage-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Elige una acción&hellip;</h5>
					<a role="button" class="close" href="{{ route('admin.board') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<div class="modal-body">
					<div class="container-fluid">
						<div class="list-group my-4">
							<a href="{{ route('admin.charges.assign', [$chargePeriod->charge]) }}"
							   class="list-group-item list-group-item-action flex-column align-items-start">
								<div class="d-flex w-100 justify-content-between">
									<h5 class="mb-1">
										<strong>Relevo</strong> de «{{ $chargePeriod->charge->internalName }}» por otra persona diferente
									</h5>
								</div>

								<p class="my-1">
									Se le asignará el puesto de «{{ $chargePeriod->charge->internalName }}» a otro socio, pero {{ $chargePeriod->user->name }}
									seguirá teniendo poderes de «{{ $chargePeriod->charge->internalName }}» hasta finalizar su periodo de cargo.
								</p>
							</a>

							<button id="manage-extend-button" class="list-group-item list-group-item-action" type="button" role="button">
								<div class="d-flex w-100 justify-content-between">
									<h5 class="mb-1">
										<strong>Reelección</strong> como «{{ $chargePeriod->charge->internalName }}» para el año que viene
									</h5>
								</div>

								<p class="my-1">
									Se prolongará el periodo de cargo de {{ $chargePeriod->user->name }}, de manera que seguirá ocupando
									el puesto de «{{ $chargePeriod->charge->internalName }}» durante un año más.
								</p>

								<small><strong>¡Ojo!</strong> Para asignarle a {{ $chargePeriod->user->name }} un cargo diferente, selecciona el
								cargo que quieras asignarle en el panel de junta.</small>
							</button>

							<button id="manage-finish-button" class="list-group-item list-group-item-action" type="button" role="button">
								<div class="d-flex w-100 justify-content-between">
									<h5 class="mb-1">
										<strong>Expulsión o dimisión</strong> de la junta directiva
									</h5>
								</div>

								<p class="my-1">
									Finalizar el periodo de cargo de {{ $chargePeriod->user->name }} ahora mismo. {{ $chargePeriod->user->name }}
									dejará de ocupar el puesto de «{{ $chargePeriod->charge->internalName }}» con efecto inmediato. Puedes volver a
									asignar el cargo de «{{ $chargePeriod->charge->internalName }}» a otro socio en cualquier momento desde el panel
									de junta.
								</p>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
