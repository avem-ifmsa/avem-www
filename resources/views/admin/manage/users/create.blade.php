@extends('admin.manage.roles.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.users.create', trans('admin.breadcrumb.create')) }}</li>
@endpush

@section('panel')
	{{ Form::open(['route' => 'admin.manage.users.store']) }}
		@include('admin.manage.users.form', [
			'submitLabel' => trans('admin.manage.users.create.submitButton')
		])
	{{ Form::close() }}
@endsection
