<p class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
	<label for="name">Nombre</label>
	<input class="form-control" name="name" type="text" required
	       value="{{ old('name') ?? (isset($charge) ? $charge->name : '') }}">
	@if ($errors->has('name'))
		<span class="form-text">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
	@endif
</p>

<p class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
	<label for="email">Dirección de correo-e</label>
	<input class="form-control" name="email" type="email" required
	       value="{{ old('email') ?? (isset($charge) ? $charge->email : '') }}">
	@if ($errors->has('email'))
		<span class="form-text">
			<strong>{{ $errors->first('email') }}</strong>
		</span>
	@endif
</p>

<p class="form-group{{ $errors->has('working_group') ? ' has-danger' : '' }}">
	<label for="working_group">Grupo de trabajo</label>
	<select class="form-control" name="working_group"
	        value="{{ old('working_group') ?? (isset($charge) ? $charge->workingGroup : 0) }}">
		<option value="">Ninguno</option>
		@foreach ($workingGroups as $workingGroup)
			<option value="{{ $workingGroup->id }}">{{ $workingGroup->name }}</option>
		@endforeach
	</select>
</p>

<p class="form-group{{ $errors->has('order') ? ' has-danger' : '' }}">
	<label for="order[]">Orden</label>
	<div class="sortable">
		<ol class="sortable-items">
			<div class="sortable-area sortable-area--before"></div>
			@foreach ($allCharges as $existingCharge)
			<li id="charge-{{$existingCharge->id}}" class="sortable-item" draggable="true">
				<input name="order[]" type="hidden" value="{{ $existingCharge->id }}">
				<span>{{ $existingCharge->name }}</span>
			</li>
			@endforeach
			@unless (isset($charge))
				<li id="charge-new" class="sortable-item" draggable="true">
					<input name="order[]" type="hidden" value="new">
					<span>Nuevo cargo</span>
				</li>
			@endif
			<div class="sortable-area sortable-area--after"></div>
		</ol>
	</div>
	@if ($errors->has('order'))
		<span class="form-text">
			<strong>{{ $errors->first('order') }}</strong>
		</span>
	@endif
</p>