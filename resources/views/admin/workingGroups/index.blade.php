@extends('layouts.admin')

@section('content')
	<h1>Gestión de grupos de trabajo</h1>
	<table class="table table-hover table-responsive">
		<thead class="thead-inverse">
			<tr>
				<th class="align-middle">Nombre</th>
				<th class="align-middle text-nowrap">
					<a {{ Gate::denies('create', Avem\WorkingGroup::class) ? 'aria-disabled=true' : '' }} role="button"
					   class="btn btn-sm btn-secondary{{ Gate::denies('create', Avem\WorkingGroup::class) ? ' disabled' : '' }}"
					   href="{{ route('admin.workingGroups.create') }}">Crear nuevo grupo de trabajo</a>
				</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($workingGroups as $workingGroup)
				<tr>
					<td>{{ $workingGroup->name }}</td>
					<td>
						<div class="form-inline">
							<a class="mx-1 btn btn-sm btn-secondary{{ Gate::denies('update', $workingGroup) ? ' disabled' : '' }}"
							{{ Gate::denies('update', $workingGroup) ? 'aria-disabled=true' : '' }} role="button"
							    href="{{ route('admin.workingGroups.edit', [$workingGroup]) }}">Editar</a>

							<form class="mx-1" action="{{ route('admin.workingGroups.destroy', [$workingGroup]) }}" method="post">
								{{ csrf_field() }}
								{{ method_field('delete') }}
								<button {{ Gate::denies('delete', $workingGroup) ? 'disabled' : '' }} role="button"
								        type="submit" class="btn btn-sm btn-danger">Eliminar</button>
							</form>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop
