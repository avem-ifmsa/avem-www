@extends('admin.manage.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.members.index', trans('admin.breadcrumb.members'), []) }}</li>
@endpush
