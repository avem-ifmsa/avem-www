@extends('admin.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to('/admin/manage', trans('admin.breadcrumb.manage')) }}</li>
@endpush

@section('panel')
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link" href="/admin/manage/activities">{{ trans('admin.manage.nav.activities') }}</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/admin/manage/members">{{ trans('admin.manage.nav.members') }}</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/admin/manage/users">{{ trans('admin.manage.nav.users') }}</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/admin/manage/roles">{{ trans('admin.manage.nav.roles') }}</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/admin/manage/permissions">{{ trans('admin.manage.nav.permissions') }}</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/admin/manage/mb-members">{{ trans('admin.manage.nav.mbMembers') }}</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/admin/manage/mb-charges">{{ trans('admin.manage.nav.mbCharges') }}</a>
		</li>
	</ul>
@endsection
