@extends('layouts.app')

@section('content')
	<form method="post" action="{{ route('auth.login') }}">
		{{ csrf_field() }}

		<div>
			<label for="email">Dirección de correo-e</label>
			<input name="email" type="email" value="{{ old('email') }}" required>
			@if ($errors->has('email'))
				<span>
					<strong>{{ $errors->first('email') }}</strong>
				</span>
			@endif
		</div>

		<div>
			<label for="password">Contraseña</label>
			<input name="password" type="password" required>
			@if ($errors->has('password'))
				<span>
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif
		</div>

		<div>
			<label>
				<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuérdame
			</label>
		</div>

		<div>
			<button type="submit">Iniciar sesión</button>
			<a href="{{ route('auth.password.request') }}">
				¿Has olvidado tu contraseña?
			</a>
		</div>
	</form>
@stop
