@extends('layouts.admin')

@section('content')
	<div class="col-lg-8 offset-lg-2">
		<h1 class="my-4">Editar cargo</h1>
		<form method="post" action="{{ route('admin.charges.update', [$charge]) }}">
			{{ csrf_field() }}
			{{ method_field('patch') }}

			@include('admin.charges.form', compact('charge', 'workingGroups'))

			<p class="my-4 text-right">
				<button type="submit" class="btn btn-primary" role="button">Guardar cargo</button>
			</p>
		</form>
	</div>
@stop
