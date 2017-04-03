@extends('layouts.admin')

@section('content')
	<div class="col-lg-8 offset-lg-2">
		<h1 class="my-4">Crear nuevo miembro de junta</h1>
		<form method="post" action="{{ route('admin.mbMembers.store') }}">
			{{ csrf_field() }}

			@include('admin.mbMembers.form', compact('users'))

			<p class="my-4 text-right">
				<button type="submit" class="btn btn-primary" role="button">Crear miembro de junta</button>
			</p>
		</form>
	</div>
@stop
