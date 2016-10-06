@extends('admin.manage.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.mb-members.index', trans('admin.breadcrumb.mbMembers'), []) }}</li>
@endpush
