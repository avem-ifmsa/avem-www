<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Tickets de actividad</title>

		<style>
			@import url('https://fonts.googleapis.com/css?family=Source+Code+Pro');

			.ticket-sheet {
				font-family: 'Source Code Pro';
			}

			.ticket-items {
				padding-left: 0;
				list-style: none;
			}

			.ticket-items::after {
				clear: both;
				content: '';
				display: block;
			}

			.ticket-item {
				float: left;
				display: block;

				width: 33%;
				height: 100px;
				padding: 10px 20px;
				box-sizing: border-box;

				border-top: 2px dashed;
				border-left: 2px dashed;

				text-transform: uppercase;

				page-break-inside: avoid;
			}

			.ticket-item:nth-child(3n+0) {
				border-right: 2px dashed;
			}

			.ticket-item:nth-child(30n + 28),
			.ticket-item:nth-child(30n + 29),
			.ticket-item:nth-child(30n + 30) {
				border-bottom: 2px dashed;
			}

			@if ($activityTickets->count() % 30 > 0)
				.ticket-item:nth-child({{ $activityTickets->count() - 2 }}),
				.ticket-item:nth-child({{ $activityTickets->count() - 1 }}),
				.ticket-item:nth-child({{ $activityTickets->count() - 0 }}) {
					border-bottom: 2px dashed;
				}
			@endif

			.ticket-head {
				position: relative;

				font-size: 0.8em;
				font-weight: 600;
				line-height: 20px;
			}

			.ticket-head::before,
			.ticket-footer::before {
				content: '';

				top: 50%;
				right: 0;
				z-index: -1;
				position: absolute;

				width: 100%;
				height: 2px;
				display: block;

				-webkit-transform: translateY(-50%);

				background-color: #000;
			}

			.ticket-head .ticket-text,
			.ticket-footer .ticket-text {
				margin: 0 -5px;
				padding: 0 5px;
				background-color: #fff;
			}

			.ticket-body {
				text-align: center;

				font-size: 2.4em;
				line-height: 40px;
			}

			.ticket-footer {
				position: relative;

				font-size: 0.6em;
				line-height: 20px;
				text-align: right;
			}

			.ticket-expiration {
				font-weight: 600;
			}
		</style>
	</head>

	<body class="ticket-sheet">
		<ul class="ticket-items">
			@foreach ($activityTickets as $ticket)
				<li class="ticket-item">
					<div class="ticket-head">
						<span class="ticket-text">Código AVEM</span>
					</div>

					<div class="ticket-body">
						<span class="ticket-code">{{ $ticket->code }}</span>
					</div>

					<div class="ticket-footer">
						<span class="ticket-text">
							Válido hasta: <span class="ticket-expiration">
							{{ $ticket->expires_at->formatLocalized('%d %h %Y') }}
							</span>
						</span>
					</div>
				</li>
			@endforeach
		</ul>
	</body>
</html>
