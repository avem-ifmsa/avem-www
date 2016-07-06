@extends('admin.manage.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.roles.index',
				trans('admin.breadcrumb.roles'), []) }}
	</li>
@endpush
