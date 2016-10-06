@extends('admin.manage.mbCharges.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.mb-charges.create', trans('admin.breadcrumb.create')) }}</li>
@endpush

@section('panel')
	{{ Form::open(['route' => 'admin.manage.mb-charges.store']) }}
		@include('admin.manage.mbCharges.form', [
			'submitLabel' => trans('admin.manage.mbCharges.create.submitButton')
		])
	{{ Form::close() }}
@endsection
