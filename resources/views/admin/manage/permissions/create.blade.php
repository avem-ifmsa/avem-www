@extends('admin.manage.permissions.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.permissions.create', trans('admin.breadcrumb.create')) }}</li>
@endpush

@section('panel')
	{{ Form::open(['route' => 'admin.manage.permissions.store']) }}
		@include('admin.manage.permissions.form', [
			'submitLabel' => trans('admin.manage.permissions.create.submitButton')
		])
	{{ Form::close() }}
@endsection
