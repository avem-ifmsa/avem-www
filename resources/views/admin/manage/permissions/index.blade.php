@extends('admin.manage.permissions.panel')

@section('panel')
	<table class="table table-hover table-compact">
		<thead>
			<tr>
				<th>{{ trans('admin.manage.permissions.index.name') }}</th>
				<th>{{ trans('admin.manage.permissions.index.displayName') }}</th>
				<th>{{ trans('admin.manage.permissions.index.description') }}</th>
				<th>
					@include('admin.manage._globalActions', [
						'createUrl' => url('/admin/manage/permissions/create'),
					])
				</th>
			</tr>
		</thead>

		<tbody>
		@foreach($permissions as $permission)
			<tr>
				<td>{{ $permission->name }}</td>
				<td>{{ $permission->display_name }}</td>
				<td>{{ $permission->description }}</td>
				<td>
					@include('admin.manage._singleActions', [
						'editUrl' => route('admin.manage.permissions.edit', [$permission]),
						'deleteUrl' => route('admin.manage.permissions.destroy', [$permission]),
					])
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
