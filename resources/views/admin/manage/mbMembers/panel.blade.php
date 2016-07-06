@extends('admin.manage.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.mb_members.index',
				trans('admin.breadcrumb.mbMembers'), []) }}
	</li>
@endpush
