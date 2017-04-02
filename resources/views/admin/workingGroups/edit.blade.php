@extends('layouts.admin')

@section('content')
	<h1 class="my-4">Editar grupo de trabajo</h1>
	<form method="post" action="{{ route('admin.workingGroups.update', [$workingGroup]) }}">
		{{ csrf_field() }}
		{{ method_field('put') }}

		@include('admin.workingGroups.form', compact('charges', 'tags'))

		<p class="my-4 text-center">
			<button class="btn btn-primary" type="submit">Guardar grupo de trabajo</button>
		</p>
	</form>
@stop
