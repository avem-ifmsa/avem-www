@extends('admin.panel')

@push('breadcrumb')
	<li class="breadcrumb-item">{{ link_to('/admin/renewals', trans('admin.breadcrumb.renewals')) }}</li>
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
				{{ $member->activeUntil ?: trans('admin.renewals.notApplicable') }}
			</td>
			<td class="text-xs-center">
				@unless ($member->is_active)
					{{ Form::open([ 'route' => [ 'admin.renewals.renew', $member ], 'class' => 'form-inline' ]) }}
						<button type="submit" class="btn btn-default btn-sm">
							<i class="fa fa-refresh"></i>
							{{ trans('admin.renewals.renewButton') }}
						</button>
					{{ Form::close() }}
				@endif
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endsection
