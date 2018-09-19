@extends('main.home')

@section('home-content')
	<section class="card p-4">
		<h3>Transacciones de puntos</h3>
		<p>Puntos totales<span>{{ $user->total_points }}</span></p>
		<a href="https://docs.google.com/document/d/1WteKp_JXuFNrAYCxur1_E4FutD0xIHeOTM7BCLr0Xho/edit?usp=sharing"><p>Lista de socios ordenados según sus puntos</p></a>
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
