@extends('admin.manage.roles.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.roles.create', trans('admin.breadcrumb.create')) }}</li>
@endpush

@section('panel')
	{{ Form::open(['route' => 'admin.manage.roles.store']) }}
		@include('admin.manage.roles.form', [
			'submitLabel' => trans('admin.manage.roles.create.submitButton')
		])
	{{ Form::close() }}
@endsection
