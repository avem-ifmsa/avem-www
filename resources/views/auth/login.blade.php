@extends('layouts.app')

@section('content')
	<form method="post" action="{{ route('login') }}">
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

		<p class="form-inline">
			<label>
				<input class="mr-2 form-control" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}> Recuérdame
			</label>
		</p>

		<p>
			<button class="btn btn-primary" type="submit">Iniciar sesión</button>
			<a href="{{ route('password.request') }}">¿Has olvidado tu contraseña?</a>
		</p>
	</form>
@stop
