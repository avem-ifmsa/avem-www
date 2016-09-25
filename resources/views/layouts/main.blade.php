@extends('layouts.app')

@push('styles')
	<style>
		body {
			font-family: 'Lato';
		}

		.fa-btn {
			margin-right: 6px;
		}
	</style>
@endpush

@section('body')
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" data-toggle="sidebar" data-target="#sidebar"
			        class="navbar-toggle collapsed hidden-md hidden-lg">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">AVEM</a>
		</div>
	</div>
</nav>

<div class="container-fluid">
	<div class="row">
		<div id="sidebar" class="sidebar sidebar-left sidebar-animate
		                         sidebar-md-show col-xs-4 col-md-2">
			@stack('sidebar-links')
		</div>

		<div class="col-md-10 col-md-offset-2">
			@yield('content')
		</div>
	</div>
</div>
@endsection
