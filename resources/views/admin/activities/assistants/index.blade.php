@extends('admin.activities.show')

@section('modal-content')
	@unless ($activity->inscribedUsers()->isEmpty())

		<form class="w-100 mt-4 input-group">
			<input class="form-control" type="search" name="q"
			       value="{{ old('q', isset($q) ? $q : '') }}"
			       placeholder="Nombre del socio">
			<span class="input-group-btn">
				<button role="button" class="btn btn-secondary">
					<i class="fa fa-search" aria-hidden="true"></i>
				</button>
			</span>
		</form>

		<table class="table">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Dirección de correo-e</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				@forelse ($users as $user)
					<tr>
						<td>{{ $user->fullName }}</td>
						<td>{{ $user->email }}</td>
						<td>
							@unless ($activity->performedActivityRecords->contains('user_id', $user->id))
								<form action="{{ route('admin.activities.assistants.witness', [$activity, $user]) }}" method="post">
									{{ csrf_field() }}
									<input type="hidden" name="performed" value="1">
									<button type="submit" class="btn btn-sm btn-block btn-primary" role="button">
										Registrar
									</button>
								</form>
							@else
								<form action="{{ route('admin.activities.assistants.witness', [$activity, $user]) }}" method="post">
									{{ csrf_field() }}
									<input type="hidden" name="performed" value="0">
									<button type="submit" class="btn btn-sm btn-block btn-primary btn-danger" role="button">
										Anular
									</button>
								</form>
							@endunless
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="3" class="text-center">
							<i class="fa fa-times mr-1"></i>
							Ningún usuario coincide con su búsqueda.
						</td>
					</tr>
				@endforelse
			</tbody>
		</table>

	@else

		<div class="my-3 text-center">
			Todavía no hay ningún usuario inscrito a esta actividad.
		</div>

	@endunless
@stop
