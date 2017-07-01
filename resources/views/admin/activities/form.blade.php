<div class="row">
	<div class="col-md-5 my-3">
		<p class="h-100">
			<input type="file" name="image" is="input-image" required
			       value="{{ isset($activity) ? $activity->imageUrl : '' }}"
			       placeholder="https://source.unsplash.com/user/avem_webmaster/likes/400x300">
		</p>
	</div>

	<div class="col-md-7">
		<p class="form-group form-group--required{{ $errors->has('name') ? ' has-danger' : '' }}">
			<label for="form-name">Nombre de la actividad</label>
			<input id="form-name" class="form-control" name="name" type="text" required
			       value="{{ old('name') ?? (isset($activity) ? $activity->name : '') }}">
			@if ($errors->has('name'))
				<span class="form-text">
					<strong>{{ $errors->first('name') }}</strong>
				</span>
			@endif
		</p>

		<p class="form-group form-group--required{{ $errors->has('description') ? ' has-danger' : '' }}">
			<label for="form-description">Descripción</label>
			<textarea id="form-description" class="form-control" name="description" required>{{
				old('description') ?? (isset($activity) ? $activity->description : '')
			}}</textarea>
			@if ($errors->has('description'))
				<span class="form-text">
					<strong>{{ $errors->first('description') }}</strong>
				</span>
			@endif
		</p>

		<div class="row">
			<div class="col-md-6">
				<p class="form-group{{ $errors->has('visibility') ? ' has-danger' : '' }}">
					<label for="form-visibility">Público objetivo</label>
					<select id="form-visibility" class="form-control" name="visibility" required>
						<option value="all"   {{ (!isset($activity)
						                      || (old('visibility') == 'all')
						                      || (isset($activity) && $activity->visibility == 'all')
						                      )? 'selected' : '' }}>Todos los socios</option>
						<option value="board" {{ ((old('visibility') == 'board')
						                      || (isset($activity) && $activity->visibility == 'board')
						                      )? 'selected' : '' }}>Miembros de junta</option>
						<option value="none"  {{ ((old('visibility') == 'none')
						                      || (isset($activity) && $activity->visibility == 'none')
						                      )? 'selected' : '' }}>Nadie</option>
					</select>
				</p>
			</div>

			<div class="col-md-6">
				<p class="form-group{{ $errors->has('points') ? ' has-danger' : '' }}">
					<label for="form-points">Puntos</label>
					<input id="form-points" class="form-control" type="number" min="0"
					       value="{{ old('points') ?? (isset($activity) ? $activity->points : '0') }}">
					@if ($errors->has('points'))
						<span class="form-text">
							<strong>{{ $errors->first('points') }}</strong>
						</span>
					@endif
				</p>
			</div>
		</div>

		<p class="form-group{{ $errors->has('tags') ? ' has-danger' : '' }}">
			<label for="form-tags">Etiquetas</label>
			<input id="form-tags" class="form-control" name="tags" type="text">
			@if ($errors->has('tags'))
				<span class="form-text">
					<strong>{{ $errors->first('tags') }}</strong>
				</span>
			@endif
		</p>
	</div>
</div>

<div>
	<p class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
		<label for="form-location">Lugar</label>
		<input name="location" id="form-location" class="form-control" type="text"
		       value="{{ old('location') ?? (isset($activity) ? $activity->location : '') }}">
		@if ($errors->has('location'))
			<span class="form-text">
				<strong>{{ $errors->first('location') }}</strong>
			</span>
		@endif
	</p>

	<div>
		<span>Fecha y hora</span>

		<div class="row">
			<p class="col-md-6 form-group{{ $errors->has('start') ? ' has-danger' : '' }}">
				<label class="label--smaller" for="form-start">Inicio de la actividad</label>
				<input id="form-start" class="form-control form-control-sm" name="start" type="datetime-local"
				       value="{{ old('start') ?? (isset($activity) ? $activity->start->format('Y-m-d\TH:i') : '') }}">
				@if ($errors->has('start'))
					<span class="form-text">
						<strong>{{ $errors->first('start') }}</strong>
					</span>
				@endif
			</p>

			<p class="col-md-6 form-group{{ $errors->has('end') ? ' has-danger' : '' }}">
				<label class="label--smaller" for="form-end">Fín de la actividad</label>
				<input id="form-end" class="form-control form-control-sm" name="end" type="datetime-local"
				       value="{{ old('end') ?? (isset($activity) ? $activity->end->format('Y-m-d\TH:i') : '' ) }}">
				@if ($errors->has('end'))
					<span class="form-text">
						<strong>{{ $errors->first('end') }}</strong>
					</span>
				@endif
			</p>
		</div>
	</div>
</div>

<div>
	<p class="form-group{{ $errors->has('inscription_policy' ? ' has-danger' : '') }}">
		<label for="form-inscription-policy">Modalidad de inscripción</label>
		<select id="form-inscripcion-policy" class="form-control" name="inscription_policy" required>
			<option value="inscribed" {{ (!isset($activity)
			                          || (old('inscription_policy') == 'inscribed')
			                          || (isset($activity) && $activity->inscriptionPolicy == 'inscribed')
			                          )? 'selected' : '' }}>Predeterminada</option>
			<option value="all"       {{ ((old('inscription_policy') == 'all')
			                          || (isset($activity) && $activity->inscriptionPolicy == 'all')
			                          )? 'selected' : '' }}>Inscribir automáticamente a todos los socios</option>
			<option value="board"     {{ ((old('inscription_policy') == 'board')
			                          || (isset($activity) && $activity->inscriptionPolicy == 'board')
			                          )? 'selected' : '' }}>Inscribir automáticamente a los miembros de junta</option>
		</select>
		@if ($errors->has('inscription_policy'))
			<span class="form-text">
				<strong>{{ $errors->first('inscription_policy') }}</strong>
			</span>
		@endif
	</p>
	
	<div>
		<span>Periodo de inscripción</span>

		<div class="row">
			<p class="col-md-6 form-group{{ $errors->has('inscription_start') ? ' has-danger' : '' }}">
				<label class="label--smaller" for="form-inscription-start">Inicio del periodo</label>
				<input id="form-inscription-start" class="form-control form-control-sm" name="inscription_start"
				       type="datetime-local" value="{{ old('inscription_start') ?? (isset($activity) && $activity->inscriptionStart
				                                       ? $activity->inscriptionStart->format('Y-m-d\TH:i') : '') }}">
				@if ($errors->has('inscription_start'))
					<span class="form-text">
						<strong>{{ $errors->first('inscription_start') }}</strong>
					</span>
				@endif
			</p>

			<p class="col-md-6 form-group{{ $errors->has('inscription_end') ? ' has-danger' : '' }}">
				<label class="label--smaller" for="form-inscription-end">Fín del periodo</label>
				<input id="form-inscription-end" class="form-control form-control-sm" name="inscription_end"
				       type="datetime-local" value="{{ old('inscription_end') ?? (isset($activity) && $activity->inscriptionEnd
				                                       ? $activity->inscriptionEnd->format('Y-m-d\TH:i') : '' ) }}">
				@if ($errors->has('inscription_end'))
					<span class="form-text">
						<strong>{{ $errors->first('inscription_end') }}</strong>
					</span>
				@endif
			</p>
		</div>
	</div>

	<p class="form-group{{ $errors->has('member_limit') ? ' has-danger' : '' }}">
		<label for="form-member-limit">Límite de socios</label>
		<input name="member_limit" id="form-member-limit" class="form-control" type="number"
		       value="{{ old('member_limit') ?? (isset($activity) ? $activity->member_limit : '') }}">
		@if ($errors->has('member_limit'))
			<span class="form-text">
				<strong>{{ $errors->first('member_limit') }}</strong>
			</span>
		@endif
	</p>
</div>

<div>
	<p class="form-group{{ $errors->has('organizers') ? ' has-danger' : '' }}">
		<label for="form-organizers">Organizadores</label>
		<select id="form-organizers" name="organizer_periods[]" class="form-control" multiple>
			@foreach($mbMemberPeriods as $period)
			@if ($period->mbMember && $period->mbMember->user)
				<option value="{{ $period->id }}" {{
					isset($organizerPeriods) &&
					$organizerPeriods->pluck('id')->contains($mbMemberPeriod->mbMember->id)
					? 'selected' : ''
				}}>
					{{ $mbMemberPeriod->mbMember->user->fullName }}
				</option>
			@endif
			@endforeach
		</select>
		@if ($errors->has('organizers'))
			<span class="form-text">
				<strong>{{ $errors->first('organizers') }}</strong>
			</span>
		@endif
	</p>
</div>