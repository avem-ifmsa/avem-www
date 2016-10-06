@extends('admin.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to('/admin/mbMembers', trans('admin.breadcrumb.mbMembers')) }}</li>
@endpush

@section('panel')
<table class="table table-hover table-compact row">
	<thead>
		<tr>
			<th>{{ trans('admin.mbMembers.memberId') }}</th>
			<th>{{ trans('admin.mbMembers.fullName') }}</th>
			<th>{{ trans('admin.mbMembers.currentCharge') }}</th>
			<th>{{ trans('admin.mbMembers.activeUntil') }}</th>
			<th class="text-xs-center">
				<div class="btn-group">
					<a class="btn btn-primary btn-sm"
					   href="{{ route('admin.manage.mb-charges.create') }}">
						<i class="fa fa-group"></i>
						{{ trans('admin.mbMembers.createMbChargeButton') }}
					</a>
					<a class="btn btn-secondary btn-sm"
					   href="{{ route('admin.manage.mb-members.create') }}">
						<i class="fa fa-user-plus"></i>
						{{ trans('admin.mbMembers.createMbMemberButton') }}
					</a>
				</div>
			</th>
		</tr>
	</thead>

	<tbody>
	@foreach ($mbMembers as $mbMember)
	@if ($mbMember->member != null)
		<tr>
			<td>{{ $mbMember->id }}</td>
			<td>{{ $mbMember->member->full_name }}</td>
			<td>
				{{ $mbMember->is_active
					? $mbMember->current_charge->name
					: trans('admin.mbMembers.notApplicable') }}
			</td>
			<td>
				{{ $mbMember->is_active
					? $mbMember->current_period->end
					: trans('admin.mbMembers.notApplicable') }}
			</td>
			<td class="text-xs-center">
				@if (!$mbMember->is_active)
					{{ Form::open([ 'route' => [ 'admin.mbMembers.activate', $mbMember ], 'class' => 'form-inline' ]) }}
						<div class="input-group">
							{{ Form::select('mb_charge', $mbCharges, old('mb_charge'), [ 'class' => 'form-control' ]) }}
							<span class="input-group-btn">
								<button type="submit" class="btn btn-primary btn-sm">
									{{ trans('admin.mbMembers.activateButton') }}
								</button>
							</span>
						</div>
					{{ Form::close() }}
				@else
					{{ Form::open([ 'route' => [ 'admin.mbMembers.deactivate', $mbMember ], 'class' => 'form-inline' ]) }}
						<button type="submit" class="btn btn-primary btn-sm">
							<i class="fa fa-remove"></i> {{ trans('admin.mbMembers.deactivateButton') }}
						</button>
					{{ Form::close() }}
				@endif
			</td>
		</tr>
	@endif
	@endforeach
	</tbody>
</table>
@endsection
