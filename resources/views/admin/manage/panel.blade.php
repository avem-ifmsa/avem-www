@extends('admin.panel')

@push('breadcrumb')
	<li>
		{{ link_to('/admin/manage', trans('admin.breadcrumb.manage')) }}
	</li>
@endpush

@push('scripts')
	<script>
		$('#manage').collapse();
	</script>
@endpush
