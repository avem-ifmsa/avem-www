@extends('admin.users.index')

@push('scripts')
	<script>
		$(function() {
			$('#index-modal').modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="index-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Transacciones del usuario <span class="user-name">{{ $user->fullName }}</span></h5>
					<a role="button" class="close" href="{{ route('admin.users.index') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<div class="modal-body">
					<div class="container-fluid">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Concepto</th>
									<th>Aplicada por</th>
									<th>Fecha</th>
									<th>Puntos</th>
								</tr>
							</thead>

							<tbody>
								@forelse ($transactions as $transaction)
									<tr>
										<td>{{ $transaction->concept }}</td>
										<td>{{ $transaction->applierPeriod->user->fullName }}</td>
										<td>{{ $transaction->created_at->formatLocalized('%d/%m/%Y %H:%M:%S') }}</td>
										<td>{{ $transaction->points }}</td>
									</tr>
								@empty
									<tr>
										<td colspan="4" class="text-center">
											<i class="fa fa-times mr-1"></i>
											Todavía no se ha realizado ninguna transacción.
										</td>
									</tr>
								@endforelse
							</tbody>
						</table>

						<a href="{{ route('admin.users.transactions.create', [$user]) }}" role="button" class="btn btn-primary btn-block{{
							Gate::denies('create', Avem\Transaction::class) ? ' disabled' : ''
						}}">
							Crear nueva transacción
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
