@extends('admin.manage.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.activities.index',
				trans('admin.breadcrumb.activities'), []) }}
	</li>
@endpush
