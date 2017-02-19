<div>
	<label for="name">Nombre</label>
	<input name="name" value="{{ old('name')
		?? (isset($charge) ? $charge->name : '') }}" required>
</div>

<div>
	<label for="email">Dirección de correo-e</label>
	<input name="email" type="email" value="{{ old('email')
		?? (isset($charge) ? $charge->email : '') }}" required>
</div>

<div>
	<label for="working_group">Grupo de trabajo</label>
	<select name="working_group" value="{{ old('working_group')
		?? (isset($charge) ? $charge->workingGroup : 0) }}">
		<option value="">Ninguno</option>
		@foreach ($workingGroups as $workingGroup)
			<option value="{{ $workingGroup->id }}">{{ $workingGroup->name }}</option>
		@endforeach
	</select>
</div>

<div>
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
</div>
