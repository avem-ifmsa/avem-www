@extends('layouts.admin')

@section('content')
	<div class="col-lg-8 offset-lg-2">
		<h1 class="my-4">Crear nuevo grupo de trabajo</h1>
		<form method="post" action="{{ route('admin.workingGroups.store') }}">
			{{ csrf_field() }}

			@include('admin.workingGroups.form', compact('charges', 'tags'))

			<p class="my-4 text-right">
				<button type="submit" class="btn btn-primary" role="button">Crear miembro de junta</button>
			</p>
		</form>
	</div>
@stop
