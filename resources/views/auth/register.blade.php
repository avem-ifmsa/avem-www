@extends('layouts.app')

@section('content')
	<form method="post" action="{{ route('register') }}">
		{{ csrf_field() }}

		<div>
			<label for="name">Nombre</label>
			<input name="name" value="{{ old('name') }}" required>
			@if ($errors->has('name'))
				<span>
					<strong>{{ $errors->first('name') }}</strong>
				</span>
			@endif
		</div>

		<div>
			<label for="surname">Apellidos</label>
			<input name="surname" value="{{ old('surname') }}" required>
			@if ($errors->has('surname'))
				<span>
					<strong>{{ $errors->first('surname') }}</strong>
				</span>
			@endif
		</div>

		<div>
			<label for="birthday">Fecha de nacimiento</label>
			<input name="birthday" type="date" value="{{ old('birthday') }}">
			@if ($errors->has('birthday'))
				<span>
					<strong>{{ $errors->first('birthday') }}</strong>
				</span>
			@endif
		</div>

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
			<label for="password_confirmation">Repita la contraseña</label>
			<input name="password_confirmation" type="password" required>
		</div>

		<div>
			<button type="submit">Registrarse</label>
		</div>
	</form>
@stop
