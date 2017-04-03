@extends('layouts.admin')

@section('content')
	<div class="col-lg-8 offset-lg-2">
		<h1 class="my-4">Editar grupo de trabajo</h1>
		<form method="post" action="{{ route('admin.workingGroups.update', [$workingGroup]) }}">
			{{ csrf_field() }}
			{{ method_field('put') }}

			@include('admin.workingGroups.form', compact('charges', 'tags'))

			<p class="my-4 text-right">
				<button type="submit" class="btn btn-primary" role="button">Guardar grupo de trabajo</button>
			</p>
		</form>
	</div>
@stop
