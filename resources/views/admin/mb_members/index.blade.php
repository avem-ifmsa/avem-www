@extends('layouts.admin')

@section('content')
	<h1>Gestión de miembros de junta</h1>

	<form class="col-lg-8 offset-lg-2">
		<p class="input-group">
			<input name="q" class="form-control" type="search" />
			<button class="btn btn-secondary input-group-addon" type="submit">Buscar</button>
		</p>
	</form>

	<p>
		<a {{ Gate::denies('create', MbMember::class) ? 'aria-disabled=true' : '' }}
		   class="btn btn-secondary{{ Gate::denies('create', MbMember::class) ? ' disabled' : '' }}"
		   href="{{ route('admin.mb_members.create') }}">Crear nuevo miembro de junta</a>
	</p>

	<ul class="list-unstyled">
		@foreach($mbMembers as $mbMember)
			<li>
				<img src="{{ $mbMember->user->imageUrl }}">
				<span>{{ $mbMember->user->fullName }}</span>
				<div>
					<a class="btn btn-secondary{{ Gate::denies('update', $mbMember) ? ' disabled' : '' }}"
					{{ Gate::denies('update', $mbMember) ? 'aria-disabled=true' : '' }}
					    href="{{ route('admin.mb_members.edit', [$mbMember]) }}">Editar</a>

					<form action="{{ route('admin.mb_members.destroy', [$mbMember]) }}" method="post">
						{{ csrf_field() }}
						{{ method_field('delete') }}
						<button {{ Gate::denies('destroy', $mbMember) ? 'disabled' : '' }}
						        type="submit" class="btn btn-danger">Eliminar</button>
					</form>
				</div>
			</li>
		@endforeach
	</ul>
@stop
