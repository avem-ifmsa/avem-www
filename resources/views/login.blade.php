@extends('app')

@section('content')
	<div id="login-form"></div>

	@include('widgets.auth0Lock', [
		'container'     => 'login-form',
		'initialScreen' => 'login',
	])
@stop
