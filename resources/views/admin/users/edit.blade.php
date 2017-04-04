@extends('layouts.admin')

@section('content')
	<div class="col-md-8 offset-md-2">
		<h1 class="my-4">Editar usuario</h1>
		<form action="{{ route('admin.users.update', [$user]) }}"
		      method="post" enctype="multipart/form-data">

			{{ csrf_field() }}
			{{ method_field('patch') }}

			@include('admin.users.form', compact('user', 'roles'))

			<p class="my-4 text-right">
				<button type="submit" class="btn btn-primary" role="button">Guardar usuario</button>
			</p>
		</form>
	</div>
@stop
