@extends('admin.panel')

@push('breadcrumb')
	<li>{{ link_to('/admin/mbMembers', trans('admin.breadcrumb.mbMembers')) }}</li>
@endpush

@section('panel')
<table class="table table-hover table-compact row">
	<thead>
		<tr>
			<th>{{ trans('admin.mbMembers.memberId') }}</th>
			<th>{{ trans('admin.mbMembers.fullName') }}</th>
			<th>{{ trans('admin.mbMembers.currentCharge') }}</th>
			<th>{{ trans('admin.mbMembers.activeUntil') }}</th>
			<th>
				<div class="btn-group">
					<a class="btn btn-default btn-sm"
					   href="{{ route('admin.manage.mb-charges.create') }}">
						<span class="glyphicon glyphicon-plus"></span>
						{{ trans('admin.mbMembers.createMbChargeButton') }}
					</a>
					<a class="btn btn-default btn-sm"
					   href="{{ route('admin.manage.mb-members.create') }}">
						<span class="glyphicon glyphicon-plus"></span>
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
			<td>
				@if (!$mbMember->is_active)
					{{ Form::open([ 'route' => [ 'admin.mbMembers.activate', $mbMember ]]) }}
						<div class="input-group input-group-sm">
							{{ Form::select('mb_charge', $mbCharges, old('mb_charge'),
									[ 'class' => 'form-control' ]) }}
							<div class="input-group-btn">
								{{ Form::submit(trans('admin.mbMembers.activateButton'),
										[ 'class' => 'btn btn-sm btn-primary' ]) }}
							</div>
						</div>
					{{ Form::close() }}
				@else
					{{ Form::open([ 'route' => [ 'admin.mbMembers.deactivate', $mbMember ]]) }}
						{{ Form::submit(trans('admin.mbMembers.deactivateButton'),
								[ 'class' => 'btn btn-sm btn-danger' ]) }}
					{{ Form::close() }}
				@endif
			</td>
		</tr>
	@endif
	@endforeach
	</tbody>
</table>
@endsection
