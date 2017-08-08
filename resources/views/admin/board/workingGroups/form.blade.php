<p class="form-group form-group--required{{ $errors->has('name') ? ' has-danger' : '' }}">
	<label for="form-name">Nombre</label>
	<input id="form-name" class="form-control" name="name" type="text"  placeholder="Educación médica"
	       value="{{ old('name', isset($workingGroup) ? $workingGroup->name : '') }}" required>
	@if ($errors->has('name'))
		<span class="form-text">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
	@endif
</p>

<div>
	<div class="row">
		<p class="col-md-9 form-group{{ $errors->has('ifmsa_name') ? ' has-danger' : '' }}">
			<label for="form-ifmsa-name">Nombre de IFMSA</label>
			<input id="form-ifmsa-name" class="form-control" name="name" type="text"
			       placeholder="Standing Committee On Medical Education&hellip;"
			       value="{{ old('ifmsa_name', isset($workingGroup) ? $workingGroup->ifmsa_name : '') }}">
		</p>

		<p class="col-md-3 form-group{{ $errors->has('ifmsa_name') ? ' has-danger' : '' }}">
			<label for="form-ifmsa-acronym">Siglas de IFMSA</label>
			<input id="form-ifmsa-acronym" class="form-control" type="text" placeholder="SCOME&hellip;"
			       value="{{ old('ifmsa_acronym', isset($workingGroup) ? $workingGroup->ifmsa_acronym : '') }}">
		</p>
	</div>

	@if ($errors->has('ifmsa_name'))
		<span class="form-text">
			<strong>{{ $errors->first('ifmsa_name') }}</strong>
		</span>
	@endif

	@if ($errors->has('ifmsa_acronym'))
		<span class="form-text">
			<strong>{{ $errors->first('ifmsa_acronym') }}</strong>
		</span>
	@endif
</div>

<p class="form-group{{ $errors->has('parent_group') ? ' has-danger' : '' }}">
	<label for="form-parent-group">Grupo de trabajo superior al que pertenece</label>
	<select id="form-parent-group" name="parent_group" class="form-control">
		<option>Ninguno</option>
		@foreach ($workingGroups as $parentGroup)
			<option value="{{ $parentGroup->id }}"{{
				(old('parent_group', isset($workingGroup) ? $workingGroup->parent_group_id : null) == $parentGroup->id) ? ' selected' : ''
			}}>{{ $parentGroup->name }}</option>
		@endforeach
	</select>
	@if ($errors->has('parent_group'))
		<span class="form-text">
			<strong>{{ $errors->first('parent_group') }}</strong>
		</span>
	@endif
</p>

<p class="form-group form-group--required{{ $errors->has('description') ? ' has-danger' : '' }}">
	<label for="form-description">Descripción del grupo de trabajo</label>
	<textarea id="form-description" class="form-control" name="description" required
	          placeholder="Se encarga de la formación médica complementaria, ampliándola mediante charlas, cursillos y otras actividades. Además, trabaja el estado de la educación médica y la docencia&hellip;"
	>{{ old('description', isset($workingGroup) ? $workingGroup->description : '') }}</textarea>
	@if ($errors->has('description'))
		<span class="form-text">
			<strong>{{ $errors->first('description') }}</strong>
		</span>
	@endif
</p>

<p class="form-group{{ $errors->has('tags') ? ' has-danger' : '' }}">
	<label>Etiquetas</label>
	<input is="token-input" type="text" class="form-control" placeholder="Educación médica, LOME, SCOME&hellip;"
	       value="{{ old('tags', isset($workingGroup) ? implode(',', $workingGroup->tags->pluck('name')->toArray('name')) : '') }}">
	@if ($errors->has('tags'))
		<span class="form-text">
			<strong>{{ $errors->first('tags') }}</strong>
		</span>
	@endif
</p>