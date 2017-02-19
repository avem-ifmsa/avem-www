<div>
	<label for="user">Usuario</label>
	<select name="user">
		@unless (isset($mbMember))
			<option selected disabled>--</option>
		@endunless
		@foreach ($users as $user)
			<option value="{{ $user->id }}"
				{{ (isset($mbMember) && $mbMember->id == $user->id) ? 'selected' : '' }}
			>{{ $user->fullName }}</option>
		@endforeach
	</select>
</div>

<div>
	<label for="dni_nif">DNI/NIF</label>
	<input name="dni_nif" value="{{ old('dni_nif') ?? (isset($mbMember) ? $mbMember->dni_nif : '') }}" required>
</div>

<div>
	<label for="phone">Teléfono</label>
	<input name="phone" type="tel" value="{{ old('phone') ?? (isset($mbMember) ? $mbMember->phone : '') }}" required>
</div>
