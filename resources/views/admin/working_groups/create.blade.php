@extends('layouts.admin')

@section('content')
	<h1 class="my-5">Crear nuevo grupo de trabajo</h1>
	<form method="post" action="{{ route('admin.working_groups.store') }}">
		{{ csrf_field() }}

		@include('admin.working_groups.form', compact('charges', 'tags'))

		<p class="my-4 text-center">
			<button class="btn btn-primary" type="submit">Crear miembro de junta</button>
		</p>
	</form>
@stop
