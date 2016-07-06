@extends('admin.manage.users.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.users.edit',
				trans('admin.breadcrumb.edit'),
				[$user]) }}
	</li>
@endpush

@section('main')
	{{ Form::model($user, [ 'method' => 'put',
			'route' => ['admin.manage.users.update', $user]
	]) }}

		@include('admin.manage.users.form', [
			'submitLabel' => trans('admin.manage.users.edit.submitButton'),
		])

	{{ Form::close() }}
@endsection
