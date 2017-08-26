@extends('main.home')

@section('home-content')
	<section class="card p-4">
		<h3>Transacciones de puntos</h3>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Concepto</th>
					<th>Fecha</th>
					<th>Puntos</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($transactions as $transaction)
					<tr>
						<td>{{ $transaction->concept }}</td>
						<td>{{ $transaction->created_at }}</td>
						<td>{{ $transaction->points }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</section>
@stop
