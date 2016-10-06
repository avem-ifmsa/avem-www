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

		<div class="container m-t-2 m-b-2">
			@yield('content')
		</div>

		<footer class="page-footer center-on-small-only">
			<div class="call-to-action">
				<ul>
					<li>
						<h5>Register for free</h5>
					</li>
					<li><a href="{{ url('register') }}" class="btn btn-danger">Register!</a></li>
				</ul>
			</div>
			<div class="footer-copyright">
				<div class="container-fluid">
					© 2016 Copyright: <a href="http://avem.es"> AVEM </a>
				</div>
			</div>
		</footer>

		<!-- JavaScripts -->
		<script src="{{ elixir('js/vendor.js') }}"></script>
		<script src="{{ elixir('js/app.js') }}"></script>

		<script>
			$(document).ready(function() {
				$('.mdb-select').material_select();
			});
		</script>

		@stack('scripts')
	</body>
</html>
