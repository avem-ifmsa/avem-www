@extends('layouts.admin')

@section('content')
	<h1 class="mt-4">Usuarios</h1>

	<form class="mt-4 w-100">
		<p class="input-group">
			<input name="q" class="form-control" type="search" value="{{ $q }}"
			       placeholder="Nombre o dirección de correo-e del usuario">
			<button class="btn btn-secondary input-group-addon"
			        type="submit" role="button">Buscar</button>
		</p>
	</form>

	<div class="mt-2 user-index">
		<ul class="user-items">
			@foreach ($users as $user)
				<li class="user-item">
					<img class="user-image" src="{{ $user->profileImageUrl }}">
					<div class="user-info">
						<span class="user-name">{{ $user->fullName }}</span>
						<span class="user-email">{{ $user->email }}</span>
					</div>
					<div class="user-actions">
						<div class="btn-group btn-group-sm">
							<a role="button" href="{{ route('admin.users.edit', [$user]) }}"
							   class="btn btn-secondary{{
								Gate::denies('update', $user) ? ' disabled' : ''
							}}">Editar</a>
							<a role="button" href="{{ route('admin.users.delete', [$user]) }}"
							   class="btn btn-danger{{
								Gate::denies('delete', $user)}} ? ' disabled' : ''
							}}">Eliminar</a>
						</div>
					</div>
				</li>
			@endforeach
		</ul>
	</div>
@stop
