@extends('admin.activities.modal')

@section('modal-content')
	@if ($activity->activityTickets->isEmpty())
		<div class="my-3 text-center">
			Todavía no se han generado tickets para esta actividad. Puedes generarlos
			<a href="{{ route('admin.activities.tickets.create', [$activity]) }}">aquí</a>.
		</div>
	@else
		<table class="table">
			<thead>
				<tr>
					<th>Expedido por</th>
					<th>Fecha de expedición</th>
					<th>Fecha de expiración</th>
					<th>Tickets canjeados</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				@foreach ($activity->ticketLots->sortBy('isExpired') as $ticketLot)
					<?php $lotTickets = Avem\ActivityTicket::fromTicketLot($ticketLot)->get() ?>
					<tr class="{{ $ticketLot->isExpired ? 'table-danger' : '' }}">
						<td>{{ $ticketLot->issuerPeriod->user->fullName }}</td>
						<td>{{ $ticketLot->created_at->diffForHumans()  }}</td>
						<td>{{ $ticketLot->expires_at->diffForHumans()  }}</td>
						<td>
							{{ $lotTickets->where('performed_activity_id', '!=', null)->count() }}
							/ {{ $lotTickets->count() }}
						</td>
						<td>
							@if (!$ticketLot->isExpired)
								<a target="_blank" role="button" class="my-1 btn btn-sm btn-block btn-secondary{{
									Gate::denies('view', $lotTickets->first()) ? ' disabled' : ''
								}}"
								   href="{{ route('admin.activities.tickets.show', [$activity, $lotTickets->first()]) }}">
									Imprimir
								</a>
								<a role="button" href="{{ route('admin.activities.tickets.expire', [$activity, $lotTickets->first()]) }}" class="btn btn-sm btn-block btn-danger{{
									Gate::denies('update', $lotTickets->first()) ? ' disabled' : ''
								}}">Expirar</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<a href="{{ route('admin.activities.tickets.create', [$activity]) }}" role="button" class="btn btn-primary btn-block{{
			Gate::denies('update', $activity) ? ' disabled' : ''
		}}">
			Generar tickets
		</a>
	@endif
@endsection
