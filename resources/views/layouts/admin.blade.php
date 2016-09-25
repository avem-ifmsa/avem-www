@extends('layouts.main')

@section('title')
	{{ trans('admin.title') }}
@endsection

@section('content')
	<div class="row">
		<nav class="col-md-3">
			<ul class="nav navbar navbar-default nav-pills nav-stacked">
				<li>
					<a href="{{ url('admin#manage')}}" data-toggle="collapse">
						{{ trans('admin.nav.manage') }}
						<div class="pull-right">
							<span class="caret"></span>
						</div>
					</a>
					<ul id="manage" class="nav collapse">
						<li>{{ link_to('/admin/manage/activities' , trans('admin.manage.nav.activities' )) }}</li>
						<li>{{ link_to('/admin/manage/members'    , trans('admin.manage.nav.members'    )) }}</li>
						<li>{{ link_to('/admin/manage/users'      , trans('admin.manage.nav.users'      )) }}</li>
						<li>{{ link_to('/admin/manage/roles'      , trans('admin.manage.nav.roles'      )) }}</li>
						<li>{{ link_to('/admin/manage/permissions', trans('admin.manage.nav.permissions')) }}</li>
						<li>{{ link_to('/admin/manage/mb-members' , trans('admin.manage.nav.mbMembers'  )) }}</li>
						<li>{{ link_to('/admin/manage/mb-charges' , trans('admin.manage.nav.mbCharges'  )) }}</li>
					</ul>
				</li>

				<li>{{ link_to('/admin/renewals'  , trans('admin.nav.renewals'  )) }}</li>
				<li>{{ link_to('/admin/mb-members', trans('admin.nav.mbMembers' )) }}</li>
				<li>{{ link_to('/admin/exchanges' , trans('admin.nav.exchanges' )) }}</li>
				<li>{{ link_to('/admin/activities', trans('admin.nav.activities')) }}</li>
				<li>{{ link_to('/admin/statistics', trans('admin.nav.statistics')) }}</li>
			</ul>
		</nav>

		<main class="col-md-9">
			<ol class="breadcrumb">
				@stack('breadcrumb')
			</ol>

			@include('flash::message')
			@yield('panel')
		</main>
	</div>
@endsection
