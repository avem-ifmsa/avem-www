@extends('layouts.admin')

@section('content')
	<h1 class="my-3">Miembros de junta</h1>

	<form>
		<div class="l-admin-head clearfix mt-2">
			<div class="float-left form-inline">
				<label class="selector-text">Mostrar miembros de junta
					<select class="ml-1 form-control form-control-sm selector-input" name="showMembers">
						<option value="active" {{
							Request::has('show') && Request::get('show') == 'active' ? 'selected' : ''
						}}>activos</option>
						<option value="all" {{
							Request::has('show') && Request::get('show') == 'all'    ? 'selected' : ''
						}}>todos</option>
					</select>
				</label>
			</div>

			<div class="float-right">
				<a role="button" href="{{ route('admin.mbMembers.create') }}"
				class="btn btn-sm btn-secondary{{ Gate::denies('create', Avem\MbMember::class) ? ' disabled' : '' }}"
				{{ Gate::denies('create', Avem\MbMember::class) ? 'aria-disabled=true' : '' }}>
					Crear nuevo perfil de junta
				</a>
			</div>
		</div>

		<div class="l-admin-search mx-auto mt-3">
			<p class="input-group">
				<input class="form-control" type="search" name="q"
					{{ Request::has('q') ? 'value='.Request::get('q') : '' }}
					placeholder="Nombre o dirección de correo-e del miembro de junta" >
				<span class="input-group-btn">
					<button class="btn btn-secondary" type="submit">
						<span class="fa fa-search"></span>
					</button>
				</span>
			</p>
		</div>
	</form>

	<div class="l-admin-main mt-4">
		<table class="table table-striped">
			<colgroup>
				<col class="l-admin-mbMember-select">
				<col class="l-admin-mbMember-name">
				<col class="l-admin-mbMember-dniNif">
				<col class="l-admin-mbMember-phone">
				<col class="l-admin-mbMember-charge">
				<col class="l-admin-mbMember-actions">
			</colgroup>

			<thead>
				<tr>
					<th></th>
					<th>Nombre</th>
					<th>DNI/NIF</th>
					<th>Teléfono</th>
					<th>Cargo actual</th>
					<th>
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($mbMembers as $mbMember)
				@unless ($mbMember->user === null)
					<tr>
						<td></td>
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
							<div class="form-inline">
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
	</div>
@stop
