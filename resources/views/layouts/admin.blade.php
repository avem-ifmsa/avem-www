@extends('layouts.app')

@section('content')
	<div class="row">
		<nav class="col-md-2">
			<ul class="nav nav-tabs md-pills pills-ins nav-stacked">
				<li class="nav-item">
					<a class="nav-link" href="/admin/manage">{{ trans('admin.nav.manage') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin/renewals">{{ trans('admin.nav.renewals') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin/mb-members">{{ trans('admin.nav.mbMembers') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin/exchanges">{{ trans('admin.nav.exchanges') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin/activities">{{ trans('admin.nav.activities') }}</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/admin/statistics">{{ trans('admin.nav.statistics') }}</a>
				</li>
			</ul>
		</nav>

		<main class="col-md-10">
			<div class="row">
				<ol class="breadcrumb">
					@stack('breadcrumb')
				</ol>

				@include('flash::message')
				@yield('panel')
			</div>
		</main>
	</div>
@endsection
