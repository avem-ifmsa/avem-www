@extends('admin.manage.mbMembers.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.mb-members.create', trans('admin.breadcrumb.create')) }}</li>
@endpush

@section('panel')
	{{ Form::open(['route' => 'admin.manage.mb-members.store']) }}
		@include('admin.manage.mbMembers.form', [
			'submitLabel' => trans('admin.manage.mbMembers.create.submitButton')
		])
	{{ Form::close() }}
@endsection
