@extends('admin.manage.mbMembers.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.mb_members.create',
				trans('admin.breadcrumb.create')) }}
	</li>
@endpush

@section('main')
	{{ Form::open(['route' => 'admin.manage.mb_members.store']) }}
		@include('admin.manage.mbMembers.form', [
			'submitLabel' => trans('admin.manage.mbMembers.create.submitButton')
		])
	{{ Form::close() }}
@endsection
