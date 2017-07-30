@extends('admin.board.index')

@push('scripts')
	<script>
		var submitButton;

		function onSelectUser(user) {
			submitButton.prop('disabled', !user);
		}

		$(function() {
			submitButton = $('#assign-submit');

			$('#assign-modal').modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="assign-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Elige un usuario&hellip;</h5>
					<a role="button" class="close" href="{{ route('admin.board') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<form action="{{ route('admin.charges.assign.confirm', [$charge]) }}" method="post">
					{{ csrf_field() }}

					<div class="modal-body">
						<div class="container-fluid">
							<p class="h6">
								Se le asignará el cargo de «{{ $charge->name }}» al usuario:
							</p>

							<div class="my-4 col-md-8 offset-md-2">
								@include('components.userSelect', [
									'name'        => 'user',
									'onchange'    => 'window.onSelectUser',
									'placeholder' => 'Selecciona un usuario&hellip;',
								])
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<a class="btn btn-secondary" href="{{ route('admin.board') }}">Cancelar</a>
						<button id="assign-submit" type="submit" class="btn btn-primary" role="button" disabled>Continuar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
