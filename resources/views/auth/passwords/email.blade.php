@extends('layouts.app')

@section('content')
	@if (session('status'))
		<div>
			{{ session('status') }}
		</div>
	@endif

	<form method="post" action="{{ route('auth.password.email') }}">
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
			<button type="submit">Enviar enlace de restablecimiento de contraseña</button>
		</div>
	</form>
@stop
