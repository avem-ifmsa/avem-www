<p class="form-group form-group--required{{ $errors->has('concept') ? ' has-danger' : '' }}">
	<label for="form-concept">Concepto</label>
	<input id="form-concept" type="text" name="concept" class="form-control" required
	       value="{{ old('concept', isset($transaction) ? $transaction->concept : '' ) }}">
	@if ($errors->has('concept'))
		<span class="form-text">
			<strong>{{ $errors->first('concept') }}</strong>
		</span>
	@endif
</p>

<p class="form-group form-group--required{{ $errors->has('points') ? ' has-danger' : '' }}">
	<label for="form-points">Puntos</label>
	<input id="form-points" type="number" step="0.25" name="points" class="form-control" required
	       value="{{ old('points', isset($transaction) ? $transaction->points : '' ) }}">
	@if ($errors->has('points'))
		<span class="form-text">
			<strong>{{ $errors->first('points') }}</strong>
		</span>
	@endif
</p>

<p class="form-group{{ $errors->has('issuer') ? ' has-danger' : '' }}">
	<label for="form-issuer">Efectuada por</label>
	<select id="form-issuer" class="form-control" disabled>
		<option value="{{ $issuerPeriod->id }}">{{ $issuerPeriod->user->fullName }}</option>
	</select>
</p>
