@extends('layouts.admin')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to('/admin', trans('admin.breadcrumb.admin')) }}</li>
@endpush
