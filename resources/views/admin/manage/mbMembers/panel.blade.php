@extends('admin.manage.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.mb-members.index',
				trans('admin.breadcrumb.mbMembers'), []) }}
	</li>
@endpush
