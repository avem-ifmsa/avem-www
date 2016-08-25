@extends('admin.manage.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.mb-charges.index',
				trans('admin.breadcrumb.mbCharges'), []) }}
	</li>
@endpush
