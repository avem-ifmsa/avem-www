<li class="tree-group {{ $level > 0 ? 'group-subgroup' : '' }} tree-group--level-{{ $level }}"
	{!! $workingGroup->color ? 'style="--wg-color: '.$workingGroup->color.'"' : '' !!}>

	<div class="group-header">
		<span class="group-name">
			{{ $workingGroup->name }}
		</span>
	</div>

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
						<div class="charge-header">
							<span class="charge-name">{{ $charge->internalName }}</span>
						</div>

						<ul class="charge-periods">
							@forelse ($charge->periods->where('isActive', true) as $period)
								<li class="charge-period">
									<a class="charge-period-link{{ Gate::denies('create', Avem\ChargePeriod::class) ? ' charge-period-link--disabled' : '' }}" href="{{
										route('admin.chargePeriods.manage', [$period])
									}}">
										<span class="period-user">{{ $period->user->fullName }} ({{ $period->user->id }})</span>
										<span class="period-end">Ocupa este cargo hasta {{ $period->end->formatLocalized('%B del %Y') }} ({{ $period->end->diffForHumans() }})</span>
									</a>
								</li>
							@empty
								<li class="charge-period charge-period--unassigned">
									<a class="charge-period-link{{ Gate::denies('create', Avem\ChargePeriod::class) ? ' charge-period-link--disabled' : '' }}" href="{{
										route('admin.charges.assign', [$charge])
									}}">
										<span class="period-user">Cargo no asignado&#8230;</span>
										<span class="period-end">Haz clic aquí para asignarlo a alguien</span>
									</a>
								</li>
							@endforelse
						</ul>
					</li>
				@endforeach

				<li class="group-charge">
					<a class="charge-new-link{{ Gate::denies('create', Avem\Charge::class) ? ' charge-new-link--disabled' : '' }}" href="{{
						route('admin.charges.create', [ 'workingGroup' => $workingGroup ])
					}}">
						<i class="fa fa-plus"></i> Nuevo cargo&#8230;
					</a>
				</li>
			</ol>
		@endif
	</div>
</li>
