@extends('admin.manage.mbMembers.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.mb-members.edit', trans('admin.breadcrumb.edit'), [$mbMember]) }}</li>
@endpush

@section('panel')
	{{ Form::model($mbMember, [ 'method' => 'put',
			'route' => ['admin.manage.mb-members.update', $mbMember]
	]) }}

		@include('admin.manage.mbMembers.form', [
			'submitLabel' => trans('admin.manage.mbMembers.edit.submitButton'),
		])

	{{ Form::close() }}
@endsection
