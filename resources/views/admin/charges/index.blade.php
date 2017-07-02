@extends('layouts.admin')

@section('content')
	<h1 class="my-3">Cargos de junta</h1>
	
	<div class="l-admin-head clearfix mt-2">
		<div class="float-right">
			<a role="button" href="{{ route('admin.charges.create') }}"
			class="btn btn-sm btn-secondary{{ Gate::denies('create', Avem\Charge::class) ? ' disabled' : '' }}"
			{{ Gate::denies('create', Avem\Charge::class) ? 'aria-disabled=true' : '' }}>
				Crear nuevo cargo de junta
			</a>
		</div>
	</div>

	<div class="l-admin-main mt-4">
		<table class="table table-striped">
			<colgroup>
				<col class="l-admin-charge-select">
				<col class="l-admin-charge-name">
				<col class="l-admin-charge-email">
				<col class="l-admin-charge-workingGroup">
				<col class="l-admin-charge-actions">
			</colgroup>

			<thead>
				<tr>
					<th></th>
					<th>Nombre</th>
					<th>Dirección de correo-e</th>
					<th>Grupo de trabajo</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				@foreach ($charges as $charge)
					<tr>
						<td></td>
						<td>{{ $charge->name }}</td>
						<td>{{ $charge->email }}</td>
						<td>{{ $charge->workingGroup ?? 'Ninguno' }}</td>
						<td>
							<div class="form-inline">
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
	</div>
@stop
