@extends('app')

@section('content')
	<div id="register-form"></div>
	@include('widgets.auth0Lock', [
		'container'     => 'register-form',
		'initialScreen' => 'signUp',
	])
@stop
