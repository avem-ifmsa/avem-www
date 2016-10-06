@extends('layouts.app')

@section('title')
	{{ trans('auth.login.title') }}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card-block">
				{{ Form::open([ 'url' => '/login' ]) }}
					<!--Header-->
					<div class="text-xs-center">
						<h3><i class="fa fa-lock"></i> {{ trans('auth.login.header') }}</h3>
						<hr class="m-t-2 m-b-2">
					</div>

					<!--Body-->
					<div class="md-form">
						<i class="fa fa-envelope prefix"></i>
						{{ Form::email('email', old('email'), [ 'class' => 'form-control' ]) }}
						{{ Form::label('email', trans('auth.login.email')) }}
					</div>

					<div class="md-form">
						<i class="fa fa-lock prefix"></i>
						{{ Form::password('password', [ 'class' => 'form-control' ]) }}
						{{ Form::label('password', trans('auth.login.password')) }}
					</div>

					<div class="text-xs-center">
						<button class="btn btn-deep-purple">{{ trans('auth.login.loginButton') }}</button>
					</div>
				{{ Form::close() }}
			</div>

			<!--Footer-->
			<div class="modal-footer">
				<div class="options">
					<p>Not a member? <a href="/register">Sign Up</a></p>
					<p>Forgot <a href="/password/reset">Password?</a></p>
				</div>
			</div>
		</div>
	</div>
@endsection
