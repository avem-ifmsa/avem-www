@extends('layouts.admin')

@section('content')
	<div class="col-lg-8 offset-lg-2">
		<h1 class="my-4">Crear nueva actividad</h1>
		<form method="post" action="{{ route('admin.activities.store') }}">
			{{ csrf_field() }}

			@include('admin.activities.form', compact('mbMemberPeriods', 'organizers'))

			<p class="my-4 text-right">
				<button type="submit" class="btn btn-primary" role="button">Crear actividad</button>
			</p>
		</form>
	</div>
@stop
