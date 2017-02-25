<p class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
	<label for="form-name">Nombre</label>
	<input id="form-name" class="form-control" name="name" type="text"
	       value="{{ old('name') ?? (isset($workingGroup) ? $workingGroup->name : '') }}">
	@if ($errors->has('name'))
		<span class="form-text">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
	@endif
</p>

<p class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
	<label for="form-description">Descripción</label>
	<textarea id="form-description" class="form-control" name="description" required>
		{{ old('description') ?? (isset($workingGroup) ? $workingGroup->description : '') }}
	</textarea>
	@if ($errors->has('description'))
		<span class="form-text">
			<strong>{{ $errors->first('description') }}</strong>
		</span>
	@endif
</p>
