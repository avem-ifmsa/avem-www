@extends('admin.manage.members.panel')

@section('main')
	<table class="table table-hover table-compact">
		<tr>
			<th>{{ trans('admin.manage.members.index.id') }}</th>
			<th>{{ trans('admin.manage.members.index.fullName') }}</th>
			<th>{{ trans('admin.manage.members.index.points') }}</th>
			<th>{{ trans('admin.manage.members.index.isActive') }}</th>
			<th>
				@include('admin.manage.actions.global', [
					'createUrl' => route('admin.manage.members.create'),
				])
			</th>
		</tr>
		@foreach($members as $member)
			<tr>
				<td>{{ $member->id }}</td>
				<td>{{ $member->full_name }}</td>
				<td>{{ $member->points }}</td>
				<td>
					{{ $member->is_active
							? trans('admin.manage.members.index.yes')
							: trans('admin.manage.members.index.no') }}
				</td>
				<td>
					@include('admin.manage.actions.local', [
						'editUrl' => route('admin.manage.members.edit', [$member]),
						'deleteUrl' => route('admin.manage.members.destroy', [$member]),
					])
				</td>
			</tr>
		@endforeach
	</table>
@endsection
