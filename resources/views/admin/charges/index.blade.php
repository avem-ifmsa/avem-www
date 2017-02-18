@extends('layouts.admin')

@section('content')
	<h1>Gestión de cargos</h1>
	<table>
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Dirección de correo-e</th>
				<th>Grupo de trabajo</th>
				<th>
					<a href="{{ route('admin.charges.create') }}">
						<img src="{{ asset('img/action-create.png') }}">
					</a>
				</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($charges as $charge)
				<tr>
					<td>{{ $charge->name }}</td>
					<td>{{ $charge->email }}</td>
					<td>{{ $charge->workingGroup ?? 'Ninguno' }}</td>
					<td>
						<ul>
							<li>
								<a href="{{ route('admin.charges.edit', [$charge]) }}">
									<img src="{{ asset('img/action-edit.png') }}">
								</a>
							</li>

							<li>
								@component('components.action', [
									'method'   => 'delete',
									'url'      => route('admin.charges.destroy', [$charge]),
								])
									<img src="{{ asset('img/action-delete.png') }}">
								@endcomponent
							</li>
						</ul>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
