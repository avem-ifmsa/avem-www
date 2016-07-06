@extends('admin.manage.members.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.members.create',
				trans('admin.breadcrumb.create')) }}
	</li>
@endpush

@section('main')
	{{ Form::open(['route' => 'admin.manage.members.store']) }}
		@include('admin.manage.members.form', [
			'submitLabel' => trans('admin.manage.members.create.submitButton')
		])
	{{ Form::close() }}
@endsection
