@extends('admin.activities.index')

@push('scripts')
	<script>
		$(function() {
			$('#creating-modal').modal();
		});

		Echo.private('Avem.User.{{ Auth::user()->id }}')
		    .listen('GeneratedActivityTicketLot', function(e) {
		    	console.log('received event');
		    	document.location.href = "{{
		    		route('admin.activities.tickets.index', [$activity])
		    	}}";
		    });
	</script>
@endpush

@section('content')
	@parent

	<div id="creating-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<header class="modal-header">
					<h5 class="modal-title">Generando tickets</h5>
				</header>

				<div class="modal-body">
					<div class="my-2 text-center">
						<i class="mr-1 fa fa-lg fa-gear fa-spin"></i>
						Se están generando los tickets. Por favor, espere&hellip;
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
