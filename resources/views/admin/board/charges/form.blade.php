<p class="form-group form-group--required">
	<label>Nombre sencillo</label>
	<input class="form-control" type="text" name="name" required
	       placeholder="Responsable de educación médica&hellip;"
	       value="{{ old('name', isset($charge) ? $charge->name : '') }}">
	@if ($errors->has('name'))
		<span class="form-text">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
	@endif
</p>

<div>
	<div class="row">
		<p class="col-md-9 form-group">
			<label>Nombre según IFMSA</label>
			<input class="form-control" type="text" name="ifmsa_name"
			       placeholder="Local Officer of Medical Education&hellip;"
			       value="{{ old('ifmsa_name', isset($charge) ? $charge->ifmsa_name : '') }}">
		</p>

		<p class="col-md-3 form-group">
			<label>Siglas según IFMSA</label>
			<input class="form-control" type="text" name="ifmsa_acronym" placeholder="LOME&hellip;"
			       value="{{ old('ifmsa_acronym', isset($charge) ? $charge->ifmsa_acronym : '') }}">
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

<p class="form-group form-group--required">
	<label>Dirección de correo-e</label>
	<input class="form-control" type="email" name="email" placeholder="lome@avem.es&hellip;"
	       value="{{ old('email', isset($charge) ? $charge->email : '') }}" required>
	@if ($errors->has('email'))
		<span class="form-text">
			<strong>{{ $errors->first('email') }}</strong>
		</span>
	@endif
</p>

<p class="form-group">
	<label>Grupo de trabajo al que pertenece</label>
	<select name="working_group" class="form-control form-control-sm">
		<option value="">Ninguno</option>
		@foreach($workingGroups as $workingGroup)
			@include('admin.board.charges._wgSelectPartial', [
				'workingGroup' => $workingGroup,
				'value' => old('working_group', isset($charge) ? $charge->working_group_id : null),
			])
		@endforeach
	</select>
	@if ($errors->has('working_group'))
		<span class="form-text">
			<strong>{{ $errors->first('working_group') }}</strong>
		</span>
	@endif
</p>

<p class="form-group form-group--required">
	<label>Descripción del cargo</label>
	<textarea name="description" class="form-control"
	          placeholder="Se encarga de la formación médica complementaria, ampliándola mediante charlas, cursillos y otras actividades. Además, trabaja el estado de la educación médica y la docencia&hellip;"
	>{{ old('description', isset($charge) ? $charge->description : '') }}</textarea>
	@if ($errors->has('description'))
		<span class="form-text">
			<strong>{{ $errors->first('description') }}</strong>
		</span>
	@endif
</p>

<p class="form-group">
	<label>Etiquetas</label>
	<input is="token-input" type="text" class="form-control" placeholder="Educación médica, LOME, SCOME&hellip;"
	       name="tags" value="{{ old('tags', isset($charge) ? $charge->ownTags->pluck('name')->implode(',') : '') }}">
	@if ($errors->has('tags'))
		<span class="form-text">
			<strong>{{ $errors->first('tags') }}</strong>
		</span>
	@endif
</p>
