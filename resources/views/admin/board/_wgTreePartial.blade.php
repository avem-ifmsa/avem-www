<li class="tree-group {{ $level > 0 ? 'group-subgroup' : '' }} tree-group--level-{{ $level }}" style="--wg-color: {{ $workingGroup->color }}">
	<span class="group-name">
		{{ $workingGroup->name }}
	</span>

	<div class="group-info">
		@if (!$workingGroup->subgroups->isEmpty())
			<ol class="group-subgroups">
				@foreach($workingGroup->subgroups->sortBy('index') as $childGroup)
					@include('admin.board._wgTreePartial', ['workingGroup' => $childGroup, 'level' => $level + 1])
				@endforeach
			</ol>
		@endif

		@if (!$workingGroup->charges->isEmpty())
			<ol class="group-charges">
				@foreach($workingGroup->charges->sortBy('index') as $charge)
					<li class="group-charge">
						<span class="charge-name">{{ $charge->internalName }}</span>

						<ul class="charge-periods">
							@forelse ($charge->periods->where('isActive', true) as $period)
								<li class="charge-period">
									<span class="period-user">{{ $period->user->fullName }} ({{ $period->user->id }})</span>
									<span class="period-end">Ocupa este cargo hasta {{ $period->end->formatLocalized('%B del %Y') }} ({{ $period->end->diffForHumans() }})</span>
								</li>
							@empty
								<li class="charge-period charge-period--unassigned">
									<span class="period-user">Cargo no asignado&#8230;</span>
									<span class="period-end">Haz clic aquí para asignarlo a alguien</span>
								</li>
							@endforelse
						</ul>
					</li>
				@endforeach

				<li class="group-charge group-charge--new{{ Gate::denies('create', Avem\Charge::class) ? ' disabled' : '' }}">
					<span class="charge-name">
						<i class="fa fa-plus"></i> Nuevo cargo&#8230;
					</span>
				</li>
			</ol>
		@endif
	</div>
</li>