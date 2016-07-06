@extends('admin.manage.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage.mb_charges.index',
				trans('admin.breadcrumb.mbCharges'), []) }}
	</li>
@endpush
