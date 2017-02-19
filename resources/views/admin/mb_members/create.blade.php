@extends('layouts.admin')

@section('content')
	<h1>Crear nuevo miembro de junta</h1>
	<form method="post" action="{{ route('admin.mb_members.store') }}">
		{{ csrf_field() }}

		@include('admin.mb_members.form', compact('users'))

		<div>
			<button type="submit">Crear miembro de junta</button>
		</div>
	</form>
@stop
