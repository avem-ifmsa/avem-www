@extends('admin.panel')

@push('breadcrumb')
	<li>
		{{ link_to_route('admin.manage',
				trans('admin.breadcrumb.manage'), []) }}
	</li>
@endpush

@push('scripts')
	<script>
		$('#manage').collapse();
	</script>
@endpush
