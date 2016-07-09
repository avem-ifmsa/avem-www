@extends('admin.manage.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.members.index',
				trans('admin.breadcrumb.members'), []) }}
	</li>
@endpush
