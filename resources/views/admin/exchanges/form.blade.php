<p class="form-group form-group--required{{ $errors->has('destination[name]') ? ' has-danger' : '' }}">
	<label for="form-destination-name">Destino</label>
	<input id="form-destination-name" type="text" class="form-control" name="destination[name]" required
	       value="{{ old('destination[name]') ?? (isset($exchange) ? $exchange->destination->name : '')}}">
	@if ($errors->has('destination[name]'))
		<span class="form-text">
			<strong>{{ $errors->first('destination[name]') }}</strong>
		</span>
	@endif
</p>

<div class="row">
	<p class="col-md-6 form-group form-group--required{{ $errors->has('destination[type]') ? ' has-danger' : '' }}">
		<label for="form-destination-type">Tipo de destino</label>
		<select id="form-destination-type" name="destination[type]" class="form-control" required>
			@unless (isset($exchange))
				<option selected disabled>--</option>
			@endunless

			<option value="national" {{
				(old('destination[type]') ?? (isset($exchange) ? $exchange->destination->type : '')) == 'national' ? 'selected' : ''
			}}>Nacional</option>

			<option value="international" {{
				(old('destination[type]') ?? (isset($exchange) ? $exchange->destination->type : '')) == 'international' ? 'selected' : ''
			}}>Internacional</option>
		</select>
	</p>

	<p class="col-md-6 form-group form-group--required{{ $errors->has('modality') ? ' has-danger' : '' }}">
		<label for="form-modality">Modalidad de intercambio</label>
		<select id="form-modality" name="modality" class="form-control" required>
			@unless (isset($exchange))
				<option selected disabled>--</option>
			@endunless

			<option value="clinical" {{
				(old('modality') ?? (isset($exchange) ? $exchange->modality : '')) == 'clinical' ? 'selected' : ''
			}}>Intercambio clínico</option>

			<option value="research" {{
				(old('modality') ?? (isset($exchange) ? $exchange->modality : '')) == 'research' ? 'selected' : ''
			}}>Intercambio de investigación</option>
		</select>
	</p>
</div>

<p class="form-group form-group--required{{ $errors->has('conditions') ? ' has-danger' : '' }}">
	<label for="form-conditions">Condiciones del intercambio</label>
	<input id="form-conditions" class="form-control" name="conditions" type="url" required
	       value="{{ old('conditions') ?? (isset($exchange) ? $exchange->conditions : '') }}">
	@if ($errors->has('conditions'))
		<span class="form-text">
			<strong>{{ $errors->first('conditions') }}</strong>
		</span>
	@endif
</p>

<p class="form-group{{ $errors->has('requirements') ? ' has-danger' : '' }}">
	<label for="form-requirements">Requisitos</label>
	<textarea id="form-requirements" class="form-control" name="requirements">{{
		old('requirements') ?? (isset($exchange) ? $exchange->requirements : '')
	}}</textarea>
	@if ($errors->has('requirements'))
		<span class="form-text">
			<strong>{{ $errors->first('requirements') }}</strong>
		</span>
	@endif
</p>

<p class="form-group{{ $errors->has('observations') ? ' has-danger' : '' }}">
	<label for="form-observations">Observaciones</label>
	<textarea id="form-observations" class="form-control" name="observations">{{
		old('observations') ?? (isset($exchange) ? $exchange->observations : '')
	}}</textarea>
	@if ($errors->has('observations'))
		<span class="form-text">
			<strong>{{ $errors->first('observations') }}</strong>
		</span>
	@endif
</p>
