@extends('admin.board.index')

@push('scripts')
	<script>
		$(function() {
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

				<form action="{{ route('admin.chargePeriods.store') }}" method="post">
					<div class="modal-body">
						<div class="container-fluid">
							<div class="col-md-8 offset-md-2">
								{{ csrf_field() }}

								<input type="hidden" name="charge" value="{{ $charge->id }}">

								@include('components.userSelect', [
									'name' => 'user', 'placeholder' => 'Selecciona un usuario&hellip;'
								])
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<a class="btn btn-secondary" href="{{ route('admin.board') }}">Cancelar</a>
						<button type="submit" class="btn btn-primary" role="button">Asignar cargo</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
