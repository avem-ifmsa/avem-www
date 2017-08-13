<div class="mx-auto my-2 my-md-4 profile-photo">
	<input class="rounded-circle" type="file" name="photo" is="input-image"
	       placeholder="{{ old('photo', isset($user) ? $user->profileImageUrl : '' ) }}">
</div>

<div class="row">
	<p class="col-md-4 form-group form-group--required{{ $errors->has('name') ? ' has-danger' : '' }}">
		<label for="form-name">Nombre</label>
		<input id="form-name" class="form-control" type="text" name="name" required
		       value="{{ old('name', isset($user) ? $user->name : '') }}">
		@if ($errors->has('name'))
			<span class="form-text">
				<strong>{{ $errors->first('name') }}</strong>
			</span>
		@endif
	</p>

	<p class="col-md-8 form-group form-group--required{{ $errors->has('surname') ? ' has-danger' : '' }}">
		<label for="form-surname">Apellidos</label>
		<input id="form-surname" class="form-control" type="text" name="surname" required
		       value="{{ old('surname', isset($user) ? $user->surname : '') }}">
		@if ($errors->has('surname'))
			<span class="form-text">
				<strong>{{ $errors->first('surname') }}</strong>
			</span>
		@endif
	</p>
</div>

<div class="row">
	<p class="col-md-6 form-group form-group--required{{ $errors->has('email') ? ' has-danger' : '' }}">
		<label for="form-email">Dirección de correo-e</label>
		<input id="form-email" class="form-control" type="email" name="email" required
		       value="{{ old('email', isset($user) ? $user->email : '') }}">
		@if ($errors->has('email'))
			<span class="form-text">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
		@endif
	</p>

	<p class="col-md-6 form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
		<label for="form-password">Contraseña</label>
		<input id="form-password" class="form-control" type="password" name="password">
		@if ($errors->has('password'))
			<span class="form-text">
				<strong>{{ $errors->first('password') }}</strong>
			</span>
		@endif
	</p>
</div>

<p class="form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
	<label for="form-gender">Género</label>
	<select is="open-select" input-id="form-gender" name="gender" value="{{ old('gender') }}">
		<option value=""       {{  (old('gender', isset($user) ? $user->gender : null)) == ''        ? 'selected' : '' }}>Prefiero no decirlo</option>
		<option value="male"   {{  (old('gender', isset($user) ? $user->gender : null)) == 'male'    ? 'selected' : '' }}>Hombre</option>
		<option value="female" {{  (old('gender', isset($user) ? $user->gender : null)) == 'female'  ? 'selected' : '' }}>Mujer</option>
		<option value="other"  {{ ((old('gender', isset($user) ? $user->gender : null)) != 'male'
		                        && (old('gender', isset($user) ? $user->gender : null)) != 'female'
		                        && (old('gender', isset($user) ? $user->gender : null)) != null)     ? 'selected' : '' }}>Otro</option>
	</select>
</p>

<p class="form-group{{ $errors->has('birthday') ? ' has-danger' : '' }}">
	<label for="form-birthday">Cumpleaños</label>
	<input id="form-birthday" class="form-control" type="date" name="birthday"
	       value="{{ old('birthday', (isset($user) && $user->birthday) ? $user->birthday->format('Y-m-d') : '') }}">
	@if ($errors->has('birthday'))
		<span class="form-text">
			<strong>{{ $errors->first('birthday') }}</strong>
		</span>
	@endif
</p>
