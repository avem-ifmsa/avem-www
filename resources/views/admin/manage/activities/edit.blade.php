@extends('admin.manage.activities.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.activities.edit',
				trans('admin.breadcrumb.edit'),
				[$activity]) }}
	</li>
@endpush

@section('main')
	{{ Form::model($activity, [ 'method' => 'put',
			'route' => ['admin.manage.activities.update', $activity]
	]) }}

		@include('admin.manage.activities.form', [
			'submitLabel' => trans('admin.manage.activities.edit.submitButton'),
		])

	{{ Form::close() }}
@endsection
