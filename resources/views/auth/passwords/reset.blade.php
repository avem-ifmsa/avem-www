@extends('layouts.app')

@section('content')
	@if (session('status'))
		<div>
			{{ session('status') }}
		</div>
	@endif

	<form method="post" action="{{ route('auth.request') }}">
		{{ csrf_field() }}

		<input type="hidden" name="token" value="{{ $token }}">

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
		</div>

		<div>
			<button type="submit">Restablecer contraseña</label>
		</div>
	</form>
@stop
