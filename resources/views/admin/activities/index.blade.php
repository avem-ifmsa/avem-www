@extends('layouts.admin')

@push('scripts')
	<script>
		$(function() {
			var $filterForm = $("#index-filter-form");
			$("#index-organized-by").change(function(event) {
				$filterForm.submit();
			});
		});
	</script>
@endpush

@section('content')
	<h1 class="my-3">Actividades</h1>

	<form id="index-filter-form">
		<div class="l-admin-head clearfix mt-2">
			<div class="float-left form-inline">
				<label class="selector-text">Actividades organizadas por
					<select id="index-organized-by" class="ml-1 form-control form-control-sm selector-input" name="organized_by">
						<option value="me" {{
							Request::has('organized_by') && Request::get('organized_by') == 'me' ? 'selected' : ''
						}}>mí</option>
						<option value="all" {{
							Request::has('organized_by') && Request::get('organized_by') == 'all' ? 'selected' : ''
						}}>todos</option>
					</select>
				</label>
			</div>
			
			<div class="float-right">
				<a role="button" href="{{ route('admin.activities.create') }}"
				@if (Gate::allows('create', Avem\Activity::class))
					class="btn btn-sm btn-secondary"
				@else
					class="btn btn-sm btn-secondary disabled" aria-disabled="true"
				@endif
				>
					Crear nueva actividad
				</a>
			</div>
		</div>

		<div class="l-admin-search mx-auto mt-3">
			<p class="input-group">
				<input class="form-control" type="search" name="q"
					{{ Request::has('q') ? 'value='.Request::get('q') : '' }}
					placeholder="Nombre o descripción de la actividad" >
				<span class="input-group-btn">
					<button class="btn btn-secondary" type="submit">
						<span class="fa fa-search"></span>
					</button>
				</span>
			</p>
		</div>
	</form>
	
	<div class="l-admin-main mt-4">
		<table class="table table-striped">
			<colgroup>
				<col class="l-admin-activity-select">
				<col class="l-admin-activity-nameAndDescription">
				<col class="l-admin-activity-location">
				<col class="l-admin-activity-start">
				<col class="l-admin-activity-inscriptionStart">
				<col class="l-admin-activity-actions">
			</colgroup>

			<thead>
				<tr>
					<th></th>
					<th>Nombre y descripción</th>
					<th>Lugar</th>
					<th>Inicio</th>
					<th>Inscripción</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				@foreach ($activities as $activity)
					<tr>
						<td>
							
						</td>
						<td>
							<span class="activity-title">{{ $activity->name }}</span><br />
							<span class="activity-description">{{ $activity->description}}</span>
						</td>
						<td>
							{{ $activity->location }}
						</td>
						<td>{{ $activity->start->diffForHumans() }}</td>
						<td>
							{{ $activity->inscription_start ? $activity->inscription_start->diffForHumans() : '--' }}
						</td>
						<td>

						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop
