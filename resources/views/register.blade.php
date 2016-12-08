@extends('app')

@section('content')
	<div id="register-form"></div>

	@include('auth0LockWidget', [
		'container'     => 'register-form',
		'initialScreen' => 'signUp',
	])
@stop
