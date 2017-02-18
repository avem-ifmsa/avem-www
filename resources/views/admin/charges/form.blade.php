<div>
	<label for="name">Nombre</label>
	<input name="name" required
	       value="{{ old('name') ?? (isset($charge) ? $charge->name : '') }}">
</div>

<div>
	<label for="email">Dirección de correo-e</label>
	<input name="email" type="email" required
	       value="{{ old('email') ?? (isset($charge) ? $charge->email : '') }}">
</div>

<div>
	<label for="working_group">Grupo de trabajo</label>
	<select name="working_group" value="{{ old('working_group') ?? (isset($charge) ? $charge->workingGroup : 0) }}">
		<option value="0">Ninguno</option>
		@foreach ($workingGroups as $workingGroup)
			<option value="{{ $workingGroup->id }}">{{ $workingGroup->name }}</option>
		@endforeach
	</select>
</div>
