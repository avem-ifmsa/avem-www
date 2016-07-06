@extends('admin.manage.activities.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.activities.create',
				trans('admin.breadcrumb.create')) }}
	</li>
@endpush

@section('main')
	{{ Form::open(['route' => 'admin.manage.activities.store']) }}
		@include('admin.manage.activities.form', [
			'submitLabel' => trans('admin.manage.activities.create.submitButton')
		])
	{{ Form::close() }}
@endsection
