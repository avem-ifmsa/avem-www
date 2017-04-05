@extends('layouts.admin')

@section('content')
	<div class="col-lg-8 offset-lg-2">
		<h1 class="my-4">Crear nuevo intercambio</h1>
		<form method="post" action="{{ route('admin.exchanges.store') }}">
			{{ csrf_field() }}

			@include('admin.exchanges.form')

			<p class="my-4 text-right">
				<button type="submit" class="btn btn-primary" role="button">Crear intercambio</button>
			</p>
		</form>
	</div>
@stop
