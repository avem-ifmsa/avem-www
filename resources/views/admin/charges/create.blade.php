@extends('layouts.admin')

@section('content')
	<h1>Crear nuevo cargo</h1>
	<form method="post" action="{{ route('admin.charges.store') }}">
		{{ csrf_field() }}

		@include('admin.charges.form', compact('workingGroups'))

		<div>
			<button type="submit">Crear cargo</button>
		</div>
	</form>
@stop
