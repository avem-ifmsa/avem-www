@extends('layouts.admin')

@section('content')
	<h1>Gestión de intercambios</h1>

	<table class="table table-hover">
		<thead class="thead-inverse">
			<tr>
				<th class="align-middle">Destino</th>
				<th class="align-middle">Tipo de destino</th>
				<th class="align-middle">Modalidad</th>
				<th class="align-middle">Activo</th>
				<th class="align-middle">
					<a class="btn btn-sm btn-secondary{{ Gate::denies('create', Avem\Exchange::class) ? ' disabled' : ''}}"
					{{ Gate::denies('create', Avem\Exchange::class) ? 'aria-disabled=true' : '' }} role="button"
					   href="{{ route('admin.exchanges.create') }}">Crear nuevo intercambio</a>
				</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($exchanges as $exchange)
				<tr>
					<td>{{ $exchange->destination->name }}</td>
					<td>{{ $exchange->destination->type }}</td>
					<td>{{ $exchange->modality          }}</td>
					<td>{{ $exchange->isActive          }}</td>
					<td>
						<div class="form-inline text-nowrap">
							<a class="mx-1 btn btn-sm btn-secondary{{ Gate::denies('update', $exchange) ? ' disabled' : ''}}"
							   {{ Gate::denies('update', $exchange) ? 'aria-disabled=true' : ''}} role="button"
							   href="{{ route('admin.exchanges.edit', [$exchange]) }}" >Editar</a>

							<form class="mx-1" action="{{ route('admin.exchanges.destroy', [$exchange]) }}" method="post">
								{{ csrf_field() }}
								{{ method_field('delete' )}}
								<button {{ Gate::denies('delete', $exchange) ? 'disabled' : '' }} role="button"
								        type="submit" class="btn btn-sm btn-danger">Eliminar</button>
							</form>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
