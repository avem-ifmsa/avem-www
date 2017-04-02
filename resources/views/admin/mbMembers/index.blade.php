@extends('layouts.admin')

@section('content')
	<h1>Gestión de miembros de junta</h1>

	<form class="my-4 col-lg-8 offset-lg-2">
		<p class="input-group">
			<input name="q" class="form-control" type="search" />
			<button class="btn btn-secondary input-group-addon" role="button"
			        type="submit" role="button">Buscar</button>
		</p>
	</form>

	<table class="table table-hover">
		<thead class="thead-inverse">
			<tr>
				<th class="align-middle">Nombre</th>
				<th class="align-middle">DNI/NIF</th>
				<th class="align-middle">Teléfono</th>
				<th class="align-middle">Cargo actual</th>
				<th class="align-middle">
					<a {{ Gate::denies('create', Avem\MbMember::class) ? 'aria-disabled=true' : '' }} role="button"
					   class="btn btn-sm btn-secondary{{ Gate::denies('create', Avem\MbMember::class) ? ' disabled' : '' }}"
					   href="{{ route('admin.mbMembers.create') }}">Crear nuevo miembro de junta</a>
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach($mbMembers as $mbMember)
			@unless ($mbMember->user === null)
				<tr>
					<td>{{ $mbMember->user->fullName }}</td>
					<td>{{ $mbMember->dni_nif        }}</td>
					<td>{{ $mbMember->phone          }}</td>
					<td>
						@if ($mbMember->hasActiveCharge)
							{{ $mbMember->mbMemberPeriods()->active()->first()->charge->name }}
							(hasta {{ $mbMember->mbMemberPeriods()->active()->first()->end->diffForHumans() }})
						@else
							Ninguno
						@endif
					</td>
					<td>
						<div class="form-inline text-nowrap">
							<a class="mx-1 btn btn-sm btn-secondary{{ Gate::denies('update', $mbMember) ? ' disabled' : '' }}"
							{{ Gate::denies('update', $mbMember) ? 'aria-disabled=true' : '' }} role="button"
							    href="{{ route('admin.mbMembers.edit', [$mbMember]) }}">Editar</a>

							<form class="mx-1 d-inline" action="{{ route('admin.mbMembers.renew', [$mbMember]) }}" method="post">
								{{ csrf_field() }}

								<span class="input-group input-group-sm">
									<button type="submit" class="input-group-addon btn btn-secondary" role="button">
										{{ $mbMember->hasActiveCharge ? 'Renovar como' : 'Asignar cargo' }}
									</button>

									<select name="charge" class="form-control" required>
										@unless ($mbMember->hasActiveCharge)
											<option value="" selected disabled>--</option>
										@endunless
										@foreach ($charges as $charge)
											<option value="{{ $charge->id }}" {{
												$mbMember->mbMemberPeriods()->where('id', $charge->id)->exists()
													? 'selected' : '' }}>{{ $charge->name }}</option>
										@endforeach
									</select>
								</span>
							</form>

							<form class="mx-1" action="{{ route('admin.mbMembers.destroy', [$mbMember]) }}" method="post">
								{{ csrf_field() }}
								{{ method_field('delete') }}
								<button {{ Gate::denies('delete', $mbMember) ? 'disabled' : '' }} role="button"
								        type="submit" class="btn btn-sm btn-danger">Eliminar</button>
							</form>
						</div>
					</td>
				</tr>
			@endunless
			@endforeach
		</tbody>
	</table>
@stop
