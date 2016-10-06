@extends('admin.manage.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.users.index', trans('admin.breadcrumb.users'), []) }}</li>
@endpush
