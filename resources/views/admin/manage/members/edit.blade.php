@extends('admin.manage.members.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.members.edit', trans('admin.breadcrumb.edit'), [$member]) }}</li>
@endpush

@section('panel')
	{{ Form::model($member, [ 'method' => 'put',
			'route' => ['admin.manage.members.update', $member]
	]) }}

		@include('admin.manage.members.form', [
			'submitLabel' => trans('admin.manage.members.edit.submitButton'),
		])

	{{ Form::close() }}
@endsection
