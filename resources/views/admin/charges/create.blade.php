@extends('layouts.admin')

@section('content')
	<div class="col-lg-8 offset-lg-2">
		<h1 class="my-4">Crear nuevo cargo</h1>
		<form method="post" action="{{ route('admin.charges.store') }}">
			{{ csrf_field() }}

			@include('admin.charges.form', compact('workingGroups'))

			<p class="my-4 text-right">
				<button type="submit" class="btn btn-primary" role="button">Crear cargo</button>
			</p>
		</form>
	</div>
@stop
