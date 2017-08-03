<div class="multi-select">
	<ul class="multi-select-items">
		@foreach ($chargePeriods as $period)
			<li class="multi-select-item">
				<label class="multi-select">
					<input type="checkbox" class="multi-select-checkbox" name="{{ $name }}" value="{{ $period->id }}" {{
						$organizerPeriods->contains('id', $period->id) ? 'checked' : ''
					}}>

					<div class="multi-select-option">
						<span class="multi-select-text">{{ $period->user->fullName }}</span>
						<span class="multi-select-text--secondary">
							{{ $period->charge->internalName }}
							@if ($period->isActive)
								actual
							@else
								hasta {{ $period->end->format('d/m/y') }}
							@endif
						</span>
					</div>
				</label>
			</li>
		@endforeach
	</ul>
</div>
