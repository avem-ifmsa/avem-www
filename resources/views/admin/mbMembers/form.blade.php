<p class="form-group form-group--required{{ $errors->has('user') ? ' has-danger' : '' }}">
	<label for="form-user">Usuario</label>
	<select id="form-user" name="user" class="form-control">
		@unless (isset($mbMember))
			<option selected disabled>--</option>
		@endunless
		@foreach ($users as $user)
			<option value="{{ $user->id }}" {{ (isset($mbMember) &&
				$mbMember->id == $user->id) ? 'selected' : ''
			}}>{{ $user->fullName }}</option>
		@endforeach
	</select>
	@if ($errors->has('user'))
		<span class="form-text">
			<strong>{{ $errors->first('user') }}</strong>
		</span>
	@endif
</p>

<div class="row">
	<p class="col-md-6 form-group form-group--required">
		<label for="form-dni-nif">DNI/NIF</label>
		<input id="form-dni-nif" class="form-control" name="dni_nif" type="text" required
		       value="{{ old('dni_nif') ?? (isset($mbMember) ? $mbMember->dni_nif : '') }}">
		@if ($errors->has('dni_nif'))
			<span class="form-text">
				<strong>{{ $errors->first('dni_nif') }}</strong>
			</span>
		@endif
	</p>

	<p class="col-md-6 form-group form-group--required">
		<label for="form-phone">Teléfono</label>
		<input id="form-phone" class="form-control" name="phone" type="tel" required
		       value="{{ old('phone') ?? (isset($mbMember) ? $mbMember->phone : '') }}">
		@if ($errors->has('phone'))
			<span class="form-text">
				<strong>{{ $errors->first('phone') }}</strong>
			</span>
		@endif
	</p>
</div>
