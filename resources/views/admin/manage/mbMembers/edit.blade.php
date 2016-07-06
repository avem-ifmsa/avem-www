@extends('admin.manage.mbMembers.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.mb_members.edit',
				trans('admin.breadcrumb.edit'),
				[$mbMember]) }}
	</li>
@endpush

@section('main')
	{{ Form::model($mbMember, [ 'method' => 'put',
			'route' => ['admin.manage.mb_members.update', $mbMember]
	]) }}

		@include('admin.manage.mbMembers.form', [
			'submitLabel' => trans('admin.manage.mbMembers.edit.submitButton'),
		])

	{{ Form::close() }}
@endsection
