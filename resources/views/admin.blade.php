@extends('app')

@section('title')
	{{ trans('admin.title') }}
@endsection

@section('content')
	<h1>{{ trans('admin.header') }}</h1>

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
						<li>
							{{ link_to_route('admin.manage.activities.index',
									trans('admin.nav.activities')) }}
						</li>
						<li>
							{{ link_to_route('admin.manage.members.index',
									trans('admin.nav.members')) }}
						</li>
						<li>
							{{ link_to_route('admin.manage.users.index',
									trans('admin.nav.users')) }}
						</li>
						<li>
							{{ link_to_route('admin.manage.roles.index',
								trans('admin.nav.roles')) }}
						</li>
						<li>
							{{ link_to_route('admin.manage.permissions.index',
									trans('admin.nav.permissions')) }}
						</li>
						<li>
							{{ link_to_route('admin.manage.mb_members.index',
								trans('admin.nav.mbMembers')) }}
						</li>
						<li>
							{{ link_to_route('admin.manage.mb_charges.index',
									trans('admin.nav.mbCharges')) }}
						</li>
					</ul>
				</li>
				<li>{{ link_to_route('admin.renewals', trans('admin.nav.renewals')) }}</li>
				<li>{{ link_to_route('admin.exchanges', trans('admin.nav.exchanges')) }}</li>
				<li>{{ link_to_route('admin.analytics', trans('admin.nav.analytics')) }}</li>
			</ul>
		</nav>

		<main class="col-md-9">
			<ol class="breadcrumb">
				@stack('breadcrumb')
			</ol>

			@include('flash::message')
			@yield('main')
		</main>
	</div>
@endsection
