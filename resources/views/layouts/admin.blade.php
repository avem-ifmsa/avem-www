<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>@yield('title')</title>

		<!-- Styles -->
		<link rel="stylesheet" href="{{ elixir('css/vendor.css') }}">
		<link rel="stylesheet" href="{{ elixir('css/app.css') }}">
		@stack('styles')
	</head>

	<body>
		<header>
			<nav class="navbar navbar-dark bg-primary">
				<button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx2">
					<i class="fa fa-bars"></i>
				</button>

				<div class="container">
					<div class="collapse navbar-toggleable-xs" id="collapseEx2">
						<a class="navbar-brand" href="#">AVEM</a>
						<ul class="nav navbar-nav">
							<li class="nav-item active">
								<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Features</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Pricing</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">About</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>

		<main class="p-t-2">
			<div class="container">
				@yield('content')
			</div>
		</main>

		<footer class="page-footer center-on-small-only">
			<div class="call-to-action">
				<ul>
					<li>
						<h5>Register for free</h5>
					</li>
					<li><a href="" class="btn btn-danger">Sign up!</a></li>
				</ul>
			</div>
			<div class="footer-copyright">
				<div class="container-fluid">
					© 2015 Copyright: <a href="http://www.MDBootstrap.com"> MDBootstrap.com </a>
				</div>
			</div>
		</footer>

		<!-- JavaScripts -->
		<script src="{{ elixir('js/vendor.js') }}"></script>
		<script src="{{ elixir('js/app.js') }}"></script>
		@stack('scripts')
	</body>
</html>

<!--
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
-->
