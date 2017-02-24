@extends('layouts.admin')

@section('content')
	<h1>Gestión de cargos</h1>
	<table class="table table-hover">
		<thead class="thead-inverse">
			<tr>
				<th class="align-middle">Nombre</th>
				<th class="align-middle">Dirección de correo-e</th>
				<th class="align-middle">Grupo de trabajo</th>
				<th class="align-middle">
					<a class="btn btn-sm btn-secondary{{ Gate::denies('create', Avem\Charge::class) ? ' disabled' : '' }}"
					{{ Gate::denies('create', Avem\Charge::class) ? 'aria-disabled=true' : '' }}
					   href="{{ route('admin.charges.create') }}">Crear nuevo cargo de junta</a>
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
						<form action="{{ route('admin.charges.destroy', $charge) }}" method="post" class="btn-group">
							{{ csrf_field() }}
							{{ method_field('delete' )}}

							<a class="btn btn-sm btn-secondary{{ Gate::denies('update', $charge) ? ' disabled' : ''}}"
							{{ Gate::denies('update', $charge) ? 'aria-disabled=true' : ''}}
							   href="{{ route('admin.charges.edit', [$charge]) }}" >Editar</a>

							<button {{ Gate::denies('destroy', $charge) ? 'disabled' : '' }}
							        type="submit" class="btn btn-sm btn-danger">Eliminar</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
