@extends('layouts.admin')

@section('content')
	<h1 class="my-4">Crear nuevo grupo de trabajo</h1>
	<form method="post" action="{{ route('admin.workingGroups.store') }}">
		{{ csrf_field() }}

		@include('admin.workingGroups.form', compact('charges', 'tags'))

		<p class="my-4 text-center">
			<button class="btn btn-primary" type="submit">Crear miembro de junta</button>
		</p>
	</form>
@stop
