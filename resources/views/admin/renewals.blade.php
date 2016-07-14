@extends('admin.panel')

@push('breadcrumb')
	<li>{{ link_to('/admin/renewals', trans('admin.breadcrumb.renewals')) }}</li>
@endpush

@section('panel')
	<table class="table table-hover table-compact row">
		<thead>
			<tr>
				<th>{{ trans('admin.renewals.memberId') }}</th>
				<th>{{ trans('admin.renewals.fullName') }}</th>
				<th>{{ trans('admin.renewals.activeUntil') }}</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
		@foreach ($members as $member)
			<tr class="{{ $member->is_active ? 'success' : '' }}">
				<td>{{ $member->id }}</td>
				<td>{{ $member->full_name }}</td>
				<td>
					{{ $member->activeUntil
						?: trans('admin.renewals.notApplicable')
					}}
				</td>
				<td>
					@include('admin.actions.renew', [
						'memberIsActive' => $member->is_active,
						'renewUrl' => action('Admin\MemberController@renew', [$member]),
					])
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
