@extends('layouts.auth')

@section('content')
	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif

	<form method="post" action="{{ route('password.request') }}">
		{{ csrf_field() }}

		<input type="hidden" name="token" value="{{ $token }}">

		<p class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
			<label for="reset-email">Dirección de correo-e</label>
			<input class="form-control" name="email" type="email" required
			       value="{{ $email or old('email') }}" autofocus>
			@if ($errors->has('email'))
				<span class="form-text">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
			@endif
		</p>

		<p class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
			<label for="reset-password">Contraseña</label>
			<input id="reset-password" class="form-control"
			       name="password" type="password" required>
			@if ($errors->has('password'))
				<span>
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif
		</p>

		<p class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
			<label for="reset-password-confirmation">Repita la contraseña</label>
			<input id="reset-password-confirmation" class="form-control"
			       name="password_confirmation" type="password" required>
			@if ($errors->has('password_confirmation'))
				<span>
					<strong>{{ $errors->first('password_confirmation') }}</strong>
				</span>
			@endif
		</p>

		<p>
			<button class="btn btn-primary" type="submit">Restablecer contraseña</label>
		</p>
	</form>
@stop
