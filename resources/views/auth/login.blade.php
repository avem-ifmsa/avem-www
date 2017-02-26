@extends('layouts.app')

@section('content')
	<div class="mt-5 mb-3 text-center">
		<img src="{{ asset('img/avem-logo.svg') }}">
	</div>

	<form class="mt-3 col-md-6 offset-md-3" method="post" action="{{ route('login') }}">
		{{ csrf_field() }}

		<p class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
			<label for="login-email">Dirección de correo-e</label>
			<input id="login-email" class="form-control" name="email" required
			       type="email" value="{{ old('email') }}" autofocus>
			@if ($errors->has('email'))
				<span class="form-text">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
			@endif
		</p>

		<p class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
			<label for="login-password">Contraseña</label>
			<input id="login-password" class="form-control" name="password"
			       type="password" required>
			@if ($errors->has('password'))
				<span class="form-text">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif
		</p>

		<p class="mt-5 text-center">
			<button class="btn btn-primary" type="submit">Iniciar sesión</button>

			<div class="mt-4 text-center">
				<a class="mr-5" href="{{ route('register') }}">¿Todavía no eres socio?</a>
				<a href="{{ route('password.request') }}">¿Has olvidado tu contraseña?</a>
			</div>
		</p>
	</form>
@stop
