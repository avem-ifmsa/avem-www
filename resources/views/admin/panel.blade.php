@extends('layouts.admin')

@push('breadcrumb')
	<li>{{ link_to('/admin', trans('admin.breadcrumb.admin')) }}</li>
@endpush
