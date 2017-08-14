@extends('admin.users.index')

@push('scripts')
	<script>
		$(function() {
			$('#create-modal').modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="create-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Renovación de usuario</h5>
					<a role="button" class="close" href="{{ route('admin.users.index') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<form action="{{ route('admin.users.renewals.store', [$user]) }}" method="post">
					{{ csrf_field() }}

					<div class="modal-body">
						<p>
							Se va a renovar al siguiente usuario:
						</p>

						<div class="my-3 user-result user-result--large text-center">
							<img class="user-image" src="{{ $user->profileImageUrl }}">
							<div class="user-info">
								<span class="user-name">{{ $user->fullName }}</span>
								<span class="user-email">{{ $user->email }}</span>
							</div>
						</div>

						<p>
							Al hacerlo, el usuario podrá:

							<ul>
								<li>Inscribirse en actividades.</li>
								<li>Recibir puntos al participar en actividades.</li>
								<li>Canjear tickets de actividad.</li>
							</ul>
						</p>

						<p>
							¿Desea continuar?
						</p>
					</div>

					<div class="modal-footer">
						<a class="btn btn-secondary" role="button" href="{{ route('admin.users.index') }}">Cancelar</a>
						<button type="submit" class="btn btn-primary" role="button">Renovar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
