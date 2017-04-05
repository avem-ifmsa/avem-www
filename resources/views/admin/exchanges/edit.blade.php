@extends('layouts.admin')

@section('content')
	<div class="col-lg-8 offset-lg-2">
		<h1 class="my-4">Editar intercambio</h1>
		<form method="post" action="{{ route('admin.exchanges.update', [$exchange]) }}">

			{{ csrf_field() }}
			{{ method_field('patch') }}

			@include('admin.exchanges.form', compact('exchange'))

			<p class="my-4 text-right">
				<button type="submit" class="btn btn-primary" role="button">Guardar intercambio</button>
			</p>
		</form>
	</div>
@stop
