@extends('layouts.admin')

@section('content')
	<h1 class="my-4">Crear nuevo miembro de junta</h1>
	<form method="post" action="{{ route('admin.mbMembers.store') }}">
		{{ csrf_field() }}

		@include('admin.mb_members.form', compact('users'))

		<p class="my-4 text-center">
			<button class="btn btn-primary" type="submit">Crear miembro de junta</button>
		</p>
	</form>
@stop
