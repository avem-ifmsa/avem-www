<p class="form-group form-group--required {{ $errors->has('name') ? ' has-danger' : '' }}">
	<label for="form-name">Nombre</label>
	<input id="form-name" class="form-control" name="name" type="text" required
	       value="{{ old('name') ?? (isset($charge) ? $charge->name : '') }}">
	@if ($errors->has('name'))
		<span class="form-text">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
	@endif
</p>

<div class="row">
	<p class="col-md-6 form-group form-group--required {{ $errors->has('email') ? ' has-danger' : '' }}">
		<label for="form-email">Dirección de correo-e</label>
		<input id="form-email" class="form-control" name="email" type="email" required
			   value="{{ old('email') ?? (isset($charge) ? $charge->email : '') }}">
		@if ($errors->has('email'))
			<span class="form-text">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
		@endif
	</p>

	<p class="col-md-6 form-group{{ $errors->has('working_group') ? ' has-danger' : '' }}">
		<label for="form-working-group">Grupo de trabajo</label>
		<select id="form-working-group" class="form-control" name="working_group"
		        value="{{ old('working_group') ?? (isset($charge) ? $charge->workingGroup : 0) }}">
			<option value="">Ninguno</option>
			@foreach ($workingGroups as $workingGroup)
				<option value="{{ $workingGroup->id }}">{{ $workingGroup->name }}</option>
			@endforeach
		</select>
	</p>
</div>

<p class="form-group form-group--required {{ $errors->has('description') ? ' has-danger' : '' }}">
	<label for="form-description">Descripción</label>
	<textarea id="form-description" class="form-control" name="description" required>{{
		old('description') ?? (isset($charge) ? $charge->description : '')
	}}</textarea>
	@if ($errors->has('description'))
		<span class="form-text">
			<strong>{{ $errors->first('description') }}</strong>
		</span>
	@endif
</p>

<p class="form-group{{ $errors->has('order') ? ' has-danger' : '' }}">
	<label>Orden</label>
	<ol is="sortable-list">
		@foreach($allCharges as $existingCharge)
			<li draggable="true">
				<input name="order[]" type="hidden" value="{{ $existingCharge->id }}">
				<span>{{ $existingCharge->name }}</span>
			</li>
		@endforeach
		@unless (isset($charge))
			<li draggable="true">
				<input name="order[]" type="hidden" value="new">
				<span>Nuevo cargo</span>
			</li>
		@endunless
	</ol>
	@if ($errors->has('order'))
		<span class="form-text">
			<strong>{{ $errors->first('order') }}</strong>
		</span>
	@endif
</p>
