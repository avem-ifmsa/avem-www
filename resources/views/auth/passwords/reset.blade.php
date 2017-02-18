@extends('layouts.app')

@section('content')
	@if (session('status'))
		<div>
			{{ session('status') }}
		</div>
	@endif

	<form method="post" action="{{ route('password.request') }}">
		{{ csrf_field() }}

		<input type="hidden" name="token" value="{{ $token }}">

		<div>
			<label for="email">Dirección de correo-e</label>
			<input name="email" type="email" value="{{ $email or old('email') }}" required autofocus>
			@if ($errors->has('email'))
				<span class="help-block">
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
			<label for="password_confirmation">Repita la contraseña</label>
			<input name="password_confirmation" type="password" required>
			@if ($errors->has('password_confirmation'))
				<span>
					<strong>{{ $errors->first('password_confirmation') }}</strong>
				</span>
			@endif
		</div>

		<div>
			<button type="submit">Restablecer contraseña</label>
		</div>
	</form>
@stop
