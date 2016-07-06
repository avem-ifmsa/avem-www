@extends('admin.manage.mbCharges.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.mb_charges.create',
				trans('admin.breadcrumb.create')) }}
	</li>
@endpush

@section('main')
	{{ Form::open(['route' => 'admin.manage.mb_charges.store']) }}
		@include('admin.manage.mbCharges.form', [
			'submitLabel' => trans('admin.manage.mbCharges.create.submitButton')
		])
	{{ Form::close() }}
@endsection
