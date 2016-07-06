@extends('admin.manage.mbCharges.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.mb_charges.edit',
				trans('admin.breadcrumb.edit'),
				[$mbCharge]) }}
	</li>
@endpush

@section('main')
	{{ Form::model($mbCharge, [ 'method' => 'put',
			'route' => ['admin.manage.mb_charges.update', $mbCharge]
	]) }}

		@include('admin.manage.mbCharges.form', [
			'submitLabel' => trans('admin.manage.mbCharges.edit.submitButton'),
		])

	{{ Form::close() }}
@endsection
