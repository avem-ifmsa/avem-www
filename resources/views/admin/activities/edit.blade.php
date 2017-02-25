@extends('layouts.admin')

@section('content')
	<h1 class="my-5">Editar actividad</h1>
	<form method="post" action="{{ route('admin.activities.update', [$activity]) }}">
		{{ csrf_field() }}
		{{ method_field('put') }}

		@include('admin.activities.form', compact('mbMemberPeriods'))

		<p class="my-4 text-center">
			<button class="btn btn-primary" type="submit">Guardar actividad</button>
		</p>
	</form>
@stop
