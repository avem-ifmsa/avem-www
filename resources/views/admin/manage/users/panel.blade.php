@extends('admin.manage.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.users.index',
				trans('admin.breadcrumb.users'), []) }}
	</li>
@endpush
