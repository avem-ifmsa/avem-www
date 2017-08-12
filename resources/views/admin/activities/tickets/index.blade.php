@extends('admin.activities.show')

@section('modal-content')
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
			@forelse ($activity->ticketLots->sortBy('isExpired') as $ticketLot)
				<tr class="{{ $ticketLot->isExpired ? 'table-danger' : '' }}">
					<td>{{ $ticketLot->issuerPeriod->user->fullName }}</td>
					<td>{{ $ticketLot->created_at->diffForHumans()  }}</td>
					<td>{{ $ticketLot->expires_at->diffForHumans()  }}</td>
					<td>
						{{ Avem\ActivityTicket::fromTicketLot($ticketLot)->exchanged()->count() }}
						/ {{ Avem\ActivityTicket::fromTicketLot($ticketLot)->count() }}
					</td>
					<td>
						@if (!$ticketLot->isExpired)
							<a target="_blank" class="my-1 btn btn-sm btn-block btn-secondary" role="button"
							   href="{{ route('admin.activities.tickets.show', [$activity, $ticketLot]) }}">
								Imprimir
							</a>
							<form action="{{ route('admin.activities.tickets.expire', [$activity, $ticketLot]) }}" method="post">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-sm btn-block btn-danger" role="button">Expirar</button>
							</form>
						@endif
					</td>
				</tr>
			@empty
				<tr>
					<td colspan="5" class="text-center">
						Todavía no se han generado tickets para esta actividad.
					</td>
				</tr>
			@endforelse
		</tbody>
	</table>

	<a class="btn btn-secondary btn-block" href="{{ route('admin.activities.tickets.create', [$activity]) }}">
		Generar tickets
	</a>
@endsection
