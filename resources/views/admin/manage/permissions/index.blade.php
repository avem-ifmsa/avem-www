@extends('admin.manage.permissions.panel')

@section('main')
	<table class="table table-hover table-compact">
		<tr>
			<th>{{ trans('admin.manage.permissions.index.name') }}</th>
			<th>{{ trans('admin.manage.permissions.index.displayName') }}</th>
			<th>{{ trans('admin.manage.permissions.index.description') }}</th>
			<th>
				@include('admin.manage.actions.global', [
					'createUrl' => route('admin.manage.permissions.create'),
				])
			</th>
		</tr>
		@foreach($permissions as $permission)
			<tr>
				<td>{{ $permission->name }}</td>
				<td>{{ $permission->display_name }}</td>
				<td>{{ $permission->description }}</td>
				<td>
					@include('admin.manage.actions.local', [
						'editUrl' => route('admin.manage.permissions.edit', [$permission]),
						'deleteUrl' => route('admin.manage.permissions.destroy', [$permission]),
					])
				</td>
			</tr>
		@endforeach
	</table>
@endsection
