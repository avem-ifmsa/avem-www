@extends('layouts.admin')

@section('content')
	<div class="col-lg-8 offset-lg-2">
		<h1 class="my-4">Editar miembro de junta</h1>
		<form method="post" action="{{ route('admin.mbMembers.update', [$mbMember]) }}">
			{{ csrf_field() }}
			{{ method_field('put') }}

			@include('admin.mbMembers.form', compact('users', 'mbMember'))

			<p class="my-4 text-right">
				<button type="submit" class="btn btn-primary" role="button">Guardar miembro</button>
			</p>
		</form>
	</div>
@stop
