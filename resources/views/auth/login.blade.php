@extends('layouts.app')

@section('content')
	<form class="mt-3 col-md-8 offset-md-2" method="post" action="{{ route('login') }}">
		{{ csrf_field() }}

		<p class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
			<label for="email">Dirección de correo-e</label>
			<input class="form-control" name="email" type="email" value="{{ old('email') }}" required>
			@if ($errors->has('email'))
				<span class="form-text">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
			@endif
		</p>

		<p class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
			<label for="password">Contraseña</label>
			<input class="form-control" name="password" type="password" required>
			@if ($errors->has('password'))
				<span class="form-text">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif
		</p>

		<p class="mt-4 mb-3 text-center">
			<button class="btn btn-primary" type="submit">Iniciar sesión</button>
		</p>

		<p class="text-center">
			<a class="mx-1" href="{{ route('register') }}">¿Todavía no eres socio?</a>
			<a href="{{ route('password.request') }}">¿Has olvidado tu contraseña?</a>
		</p>
	</form>
@stop
