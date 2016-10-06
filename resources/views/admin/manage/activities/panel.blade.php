@extends('admin.manage.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to_route('admin.manage.activities.index', trans('admin.breadcrumb.activities'), []) }}</li>
@endpush
