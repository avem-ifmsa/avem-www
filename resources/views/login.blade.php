@extends('app')

@section('content')
	<div id="login-form"></div>

	@include('auth0LockWidget', [
		'container'     => 'login-form',
		'initialScreen' => 'login',
	])
@stop
