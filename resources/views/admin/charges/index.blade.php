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
					{{ Gate::denies('create', Avem\Charge::class) ? 'aria-disabled=true' : '' }} role="button"
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
						<div class="form-inline text-nowrap">
							<a class="mx-1 btn btn-sm btn-secondary{{ Gate::denies('update', $charge) ? ' disabled' : ''}}"
							{{ Gate::denies('update', $charge) ? 'aria-disabled=true' : ''}} role="button"
							   href="{{ route('admin.charges.edit', [$charge]) }}" >Editar</a>

							<form class="mx-1" action="{{ route('admin.charges.destroy', $charge) }}" method="post">
   								{{ csrf_field() }}
   								{{ method_field('delete' )}}
								<button {{ Gate::denies('delete', $charge) ? 'disabled' : '' }} role="button"
								        type="submit" class="btn btn-sm btn-danger">Eliminar</button>
							</form>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
