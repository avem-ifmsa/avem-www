@extends('layouts.admin')

@section('content')
	<h1 class="my-5">Crear nuevo cargo</h1>
	<form method="post" action="{{ route('admin.charges.store') }}">
		{{ csrf_field() }}

		@include('admin.charges.form', compact('workingGroups'))

		<p class="my-4 text-center">
			<button class="btn btn-primary" type="submit">Crear cargo</button>
		</p>
	</form>
@stop
