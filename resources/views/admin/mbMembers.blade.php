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
			<th></th>
		</tr>
	</thead>

	<tbody>
	@foreach ($mbMembers as $mbMember)
	@if ($mbMember->member)
		<tr>
			<td>{{ $mbMember->id }}</td>
			<td>{{ $mbMember->member->full_name }}</td>
			<td>
				{{ $mbMember->is_active
					? $mbMember->current_charge->name
					: trans('admin.mbMembers.notApplicable') }}
			</td>
			<td>
				{{ Form::open([ 'route' => [ 'admin.mbMembers.activate', $mbMember]]) }}
					<div class="input-group input-group-sm">
						@if ($period = $mbMember->current_period)
							{{ Form::select('mb_charge', $mbCharges, $period->mbCharge->id, [ 'class' => 'form-control' ]) }}
						@else
							{{ Form::select('mb_charge', $mbCharges, old('mb_charge'), [ 'class' => 'form-control' ]) }}
						@endif
						<div class="input-group-btn">
							{{ Form::submit(trans('admin.mbMembers.activateButton'), [
									'class' => 'btn btn-sm btn-primary' ]) }}
						</div>
					</div>
				{{ Form::close() }}
			</td>
		</tr>
	@endif
	@endforeach
	</tbody>
</table>
@endsection
