@extends('admin.manage.roles.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.roles.edit', trans('admin.breadcrumb.edit'), [$role]) }}</li>
@endpush

@section('panel')
	{{ Form::model($role, [ 'method' => 'put',
			'route' => ['admin.manage.roles.update', $role]
	]) }}

		@include('admin.manage.roles.form', [
			'submitLabel' => trans('admin.manage.roles.edit.submitButton'),
		])

	{{ Form::close() }}
@endsection
