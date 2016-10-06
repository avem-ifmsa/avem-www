@extends('admin.manage.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.permissions.index', trans('admin.breadcrumb.permissions'), []) }}</li>
@endpush
