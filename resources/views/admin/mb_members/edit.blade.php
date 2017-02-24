@extends('layouts.admin')

@section('content')
	<h1>Editar miembro de junta</h1>
	<form method="post" action="{{ route('admin.mb_members.update', [$mbMember]) }}">
		{{ csrf_field() }}
		{{ method_field('put') }}

		@include('admin.mb_members.form', compact('users', 'mbMember'))

		<p>
			<button class="btn btn-primary" type="submit">Guardar miembro</button>
		</p>
	</form>
@stop