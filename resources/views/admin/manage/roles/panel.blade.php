@extends('admin.manage.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.roles.index', trans('admin.breadcrumb.roles'), []) }}</li>
@endpush
