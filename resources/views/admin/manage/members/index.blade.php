@extends('admin.manage.members.panel')

@section('panel')
	<table class="table table-hover table-compact">
		<thead>
			<tr>
				<th>{{ trans('admin.manage.members.index.id') }}</th>
				<th>{{ trans('admin.manage.members.index.fullName') }}</th>
				<th>{{ trans('admin.manage.members.index.email') }}</th>
				<th>{{ trans('admin.manage.members.index.points') }}</th>
				<th>{{ trans('admin.manage.members.index.isActive') }}</th>
				<th>
					@include('admin.manage._globalActions', [
						'createUrl' => url('/admin/manage/members/create'),
					])
				</th>
			</tr>
		</thead>

		<tbody>
		@foreach($members as $member)
			<tr>
				<td>{{ $member->id }}</td>
				<td>{{ $member->full_name }}</td>
				<td>
					{{ $member->email ?:
							trans('admin.manage.members.index.notApplicable')
					}}
				</td>
				<td>{{ $member->points }}</td>
				<td>
					{{ $member->is_active
							? trans('admin.manage.members.index.yes')
							: trans('admin.manage.members.index.no') }}
				</td>
				<td>
					@include('admin.manage._singleActions', [
						'editUrl' => route('admin.manage.members.edit', [$member]),
						'deleteUrl' => route('admin.manage.members.destroy', [$member]),
					])
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
