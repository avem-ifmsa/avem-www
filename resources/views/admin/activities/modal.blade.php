@extends('admin.activities.index')

@push('scripts')
	<script>
		$(function() {
			$('#show-modal').modal();
		});
	</script>
@endpush

@section('content')
	@parent

	<div id="show-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">{{ $activity->name }}</h5>
					<a role="button" class="close" href="{{ route('admin.activities.index') }}" aria-label="Cerrar">
						<span aria-hidden="true">&times;</span>
					</a>
				</header>

				<div class="modal-body">
					<div class="container-fluid">
						<ul class="nav nav-tabs">
							<li class="nav-item">
								<a class="nav-link{{
									Route::currentRouteName() === 'admin.activities.show' ? ' active' : ''
								}}" href="{{ route('admin.activities.show', [$activity]) }}">
									Información de la actividad
								</a>
							</li>

							<li class="nav-item">
								<a class="nav-link{{
									Route::currentRouteName() === 'admin.activities.assistants.index' ? ' active' : ''
								}}" href="{{ route('admin.activities.assistants.index', [$activity]) }}">
									Asistentes
								</a>
							</li>

							<li class="nav-item">
								<a class="nav-link{{
									Route::currentRouteName() === 'admin.activities.tickets.index' ? ' active' : ''
								}}" href="{{ route('admin.activities.tickets.index', [$activity]) }}">
									Tickets
								</a>
							</li>
						</ul>

						<div>
							@yield('modal-content')
						</div>
					</div>
				</div>

				<div class="modal-footer">
					@yield('modal-footer')
				</div>
			</div>
		</div>
	</div>
@stop
