@extends('layouts.app')

@section('content')
	<form class="mt-3 col-md-10 offset-md-1 col-lg-8 offset-lg-2"
	      action="{{ route('register') }}" method="post" enctype="multipart/form-data">

		{{ csrf_field() }}

		<div class="mx-auto mb-3 profile-photo">
			<input type="file" is="input-image" name="photo"
			       placeholder="img/user-default-image.svg"
			       class="rounded-circle">
		</div>

		<div class="row">
			<p class="col-md-4 form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
				<label for="register-name">Nombre</label>
				<input id="register-name" class="form-control" name="name"
				       type="text" value="{{ old('name') }}" required>
				@if ($errors->has('name'))
					<span class="form-text">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
			</p>

			<p class="col-md-8 form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
				<label for="register-surname">Apellidos</label>
				<input id="register-surname" class="form-control" name="surname"
				       type="text" value="{{ old('surname') }}" required>
				@if ($errors->has('surname'))
					<span class="form-text">
						<strong>{{ $errors->first('surname') }}</strong>
					</span>
				@endif
			</p>
		</div>

		<p class="form-group">
			<label for="register-gender">Género</label>
			<select input-id="register-gender" is="open-select" name="gender" value="{{ old('gender') }}">
				<option value="">Prefiero no decirlo</option>
				<option value="male"   {{  old('gender') == 'male'    ? 'selected' : '' }}>Hombre</option>
				<option value="female" {{  old('gender') == 'female'  ? 'selected' : '' }}>Mujer</option>
				<option value="other"  {{ (old('gender') != null
				                       &&  old('gender') != 'male'
				                       &&  old('gender') != 'female') ? 'selected' : '' }}>Otro</option>
			</select>
		</p>

		<div class="row">
			<p class="col-md-4 form-group{{ $errors->has('birthday') ? ' has-danger' : '' }}">
				<label for="register-birthday">Fecha de nacimiento</label>
				<input id="register-birthday" class="form-control" name="birthday"
				       type="date" value="{{ old('birthday') }}">
				@if ($errors->has('birthday'))
					<span class="form-text">
						<strong>{{ $errors->first('birthday') }}</strong>
					</span>
				@endif
			</p>

			<p class="col-md-8 form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
				<label for="register-email">Dirección de correo-e</label>
				<input id="register-email" class="form-control" name="email"
				       type="email" value="{{ old('email') }}" required>
				@if ($errors->has('email'))
					<span class="form-text">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			</p>
		</div>

		<div class="row">
			<p class="col-md-6 form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
				<label for="register-password">Contraseña</label>
				<input id="register-password" class="form-control"
				       name="password" type="password" required>
				@if ($errors->has('password'))
					<span class="form-text">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
			</p>

			<p class="col-md-6 form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
				<label for="register-password-confirmation">Repita la contraseña</label>
				<input id="register-password-confirmation" class="form-control"
				       name="password_confirmation" type="password" required>
				@if ($errors->has('password_confirmation'))
					<span class="form-text">
						<strong>{{ $errors->first('password_confirmation') }}</span>
					</span>
				@endif
			</p>
		</div>

		<p class="mt-4 text-center">
			<button class="btn btn-primary" type="submit">Registrarse</button>
		</p>
	</form>
@stop
