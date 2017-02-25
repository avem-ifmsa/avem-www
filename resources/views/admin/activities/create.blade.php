@extends('layouts.admin')

@section('content')
	<h1 class="my-5">Crear nueva actividad</h1>
	<form method="post" action="{{ route('admin.activities.store') }}">
		{{ csrf_field() }}

		@include('admin.activities.form', compact('mbMemberPeriods', 'organizers'))

		<p class="my-4 text-center">
			<button class="btn btn-primary" type="submit">Crear actividad</button>
		</p>
	</form>
@stop
