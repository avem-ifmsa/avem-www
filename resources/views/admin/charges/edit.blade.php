@extends('layouts.admin')

@section('content')
	<h1>Editar cargo</h1>
	<form method="post" action="{{ route('admin.charges.update', [$charge]) }}">
		{{ csrf_field() }}
		{{ method_field('patch') }}

		@include('admin.charges.form', compact('charge', 'workingGroups'))

		<div>
			<button type="submit">Guardar cargo</button>
		</div>
	</form>
@stop
