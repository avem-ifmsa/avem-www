@extends('layouts.admin')

@section('content')
	<h1>Gestión de usuarios</h1>

	<form class="my-4 col-lg-8 offset-lg-2">
		<p class="input-group">
			<input name="q" class="form-control" type="search" />
			<button class="btn btn-secondary input-group-addon"
			        type="submit" role="button">Buscar</button>
		</p>
	</form>

	<table class="table table-hover">
		<thead class="thead-inverse">
			<tr>
				<th class="align-middle">Nombre</th>
				<th class="align-middle">Dirección de correo-e</th>
				<th class="align-middle"></th>
			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->fullName }}</td>
					<td>{{ $user->email }}</td>
					<td>
						<div class="form-inline text-nowrap">
							<a class="mx-1 btn btn-sm btn-secondary{{ Gate::denies('update', $user) ? ' disabled' : ''}}"
							   {{ Gate::denies('update', $user) ? 'aria-disabled=true' : ''}} role="button"
							   href="{{ route('admin.users.edit', [$user]) }}" >Editar</a>

							<form class="mx-1" action="{{ route('admin.users.destroy', $user) }}" method="post">
								{{ csrf_field() }}
								{{ method_field('delete' )}}
								<button {{ Gate::denies('delete', $user) ? 'disabled' : '' }} role="button"
								        type="submit" class="btn btn-sm btn-danger">Eliminar</button>
							</form>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
