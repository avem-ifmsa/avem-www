@extends('layouts.app')

@section('content')
	<form method="post" action="{{ route('register') }}">
		{{ csrf_field() }}

		<div class="row">
			<p class="col-md-4 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
				<label for="name">Nombre</label>
				<input class="form-control" name="name" type="text" value="{{ old('name') }}" required>
				@if ($errors->has('name'))
					<span class="form-text">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
			</p>

			<p class="col-md-8 form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
				<label for="surname">Apellidos</label>
				<input class="form-control" name="surname" type="text" value="{{ old('surname') }}" required>
				@if ($errors->has('surname'))
					<span class="form-text">
						<strong>{{ $errors->first('surname') }}</strong>
					</span>
				@endif
			</p>
		</div>

		<div class="row">
			<p class="col-md-4 form-group{{ $errors->has('birthday') ? ' has-danger' : '' }}">
				<label for="birthday">Fecha de nacimiento</label>
				<input class="form-control" name="birthday" type="date" value="{{ old('birthday') }}">
				@if ($errors->has('birthday'))
					<span class="form-text">
						<strong>{{ $errors->first('birthday') }}</strong>
					</span>
				@endif
			</p>

			<p class="col-md-8 form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
				<label for="email">Dirección de correo-e</label>
				<input class="form-control" name="email" type="email" value="{{ old('email') }}" required>
				@if ($errors->has('email'))
					<span class="form-text">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			</p>
		</div>

		<div class="row">
			<p class="col-md-6 form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
				<label for="password">Contraseña</label>
				<input class="form-control" name="password" type="password" required>
				@if ($errors->has('password'))
					<span class="form-text">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
			</p>

			<p class="col-md-6 form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
				<label for="password_confirmation">Repita la contraseña</label>
				<input class="form-control" name="password_confirmation" type="password" required>
				@if ($errors->has('password_confirmation'))
					<span class="form-text">
						<strong>{{ $errors->first('password_confirmation') }}</span>
					</span>
				@endif
			</p>
		</div>

		<p>
			<button class="btn btn-primary" type="submit">Registrarse</button>
		</p>
	</form>
@stop
