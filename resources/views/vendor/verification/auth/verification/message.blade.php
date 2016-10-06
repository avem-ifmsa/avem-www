@extends('layouts.app')

<!-- Main Content -->
@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card-block">
				<div class="text-xs-center">
					<h3>Verify Account</h3>
					<hr class="m-t-2 m-b-2">
				</div>

				<div class="panel-body">
					In order to verify your account, you have to click on the link in your inbox.
				</div>

				<div class="text-xs-center">
					<a href="{{ route('verification.resend') }}">Resend Link</a>
				</div>
			</div>
		</div>
	</div>
@endsection
