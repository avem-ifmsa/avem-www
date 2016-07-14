@extends('admin.manage.permissions.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.permissions.edit',
				trans('admin.breadcrumb.edit'),
				[$permission]) }}
	</li>
@endpush

@section('panel')
	{{ Form::model($permission, [ 'method' => 'put',
			'route' => ['admin.manage.permissions.update', $permission]
	]) }}

		@include('admin.manage.permissions.form', [
			'submitLabel' => trans('admin.manage.permissions.edit.submitButton'),
		])

	{{ Form::close() }}
@endsection
