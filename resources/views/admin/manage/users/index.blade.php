@extends('admin.manage.users.panel')

@section('main')
	<table class="table table-hover table-compact">
		<thead>
			<tr>
				<th>{{ trans('admin.manage.users.index.email') }}</th>
				<th>{{ trans('admin.manage.users.index.member') }}</th>
				<th>
					@include('admin.manage.actions.global', [
						'createUrl' => route('admin.manage.users.create'),
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
					@include('admin.manage.actions.local', [
						'editUrl' => route('admin.manage.users.edit', [$user]),
						'deleteUrl' => route('admin.manage.users.destroy', [$user]),
					])
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
