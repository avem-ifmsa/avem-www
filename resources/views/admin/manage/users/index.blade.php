@extends('admin.manage.users.panel')

@section('panel')
	<table class="table table-hover table-compact">
		<thead>
			<tr>
				<th>{{ trans('admin.manage.users.index.email') }}</th>
				<th>{{ trans('admin.manage.users.index.member') }}</th>
				<th>
					@include('admin.manage._globalActions', [
						'createUrl' => url('/admin/manage/users/create'),
					])
				</th>
			</tr>
		</thead>

		<tbody>
		@foreach($users as $user)
			<tr>
				<td>{{ $user->email }}</td>
				<td>
					@if ($member = $user->member)
						{{ $member->full_name }} ({{ $member->id }})
					@else
						{{ trans('admin.manage.users.index.notApplicable') }}
					@endif
				</td>
				<td>
					@include('admin.manage._singleActions', [
						'editUrl' => route('admin.manage.users.edit', [$user]),
						'deleteUrl' => route('admin.manage.users.destroy', [$user]),
					])
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
