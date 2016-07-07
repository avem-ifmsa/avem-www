@extends('admin.manage.mbCharges.panel')

@section('main')
	<table class="table table-hover table-compact">
		<tr>
			<th>{{ trans('admin.manage.activities.index.name') }}</th>
			<th>{{ trans('admin.manage.activities.index.isPublic') }}</th>
			<th>{{ trans('admin.manage.activities.index.isAvailable') }}</th>
			<th>{{ trans('admin.manage.activities.index.start') }}</th>
			<th>{{ trans('admin.manage.activities.index.end') }}</th>
			<th>
				@include('admin.manage.actions.global', [
					'createUrl' => route('admin.manage.activities.create'),
				])
			</th>
		</tr>

		@foreach($activities as $activity)
			<tr>
				<td>{{ $activity->name }}</td>
				<td>{{ $activity->is_public }}</td>
				<td>{{ $activity->is_available }}</td>
				<td>{{ $activity->start }}</td>
				<td>{{ $activity->end }}</td>
				<td>
					@include('admin.manage.actions.local', [
						'editUrl' => route('admin.manage.activities.edit', [$activity]),
						'deleteUrl' => route('admin.manage.activities.destroy', [$activity]),
					])
				</td>
			</tr>
		@endforeach
	</table>
@endsection
