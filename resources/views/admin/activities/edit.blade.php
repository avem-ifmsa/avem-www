@extends('layouts.admin')

@section('content')
	<div class="col-lg-8 offset-lg-2">
		<h1 class="my-4">Editar actividad</h1>
		<form method="post" action="{{ route('admin.activities.update', [$activity]) }}">

			{{ csrf_field() }}
			{{ method_field('put') }}

			@include('admin.activities.form', compact('mbMemberPeriods'))

			<p class="my-4 text-right">
				<button type="submit" class="btn btn-primary" role="button">Guardar actividad</button>
			</p>
		</form>
	</div>
@stop
