@extends('admin.manage.roles.panel')

@section('panel')
	<table class="table table-hover table-compact">
		<thead>
			<tr>
				<th>{{ trans('admin.manage.roles.index.name') }}</th>
				<th>{{ trans('admin.manage.roles.index.displayName') }}</th>
				<th>{{ trans('admin.manage.roles.index.description') }}</th>
				<th>
					@include('admin.manage._globalActions', [
						'createUrl' => url('/admin/manage/roles/create'),
					])
				</th>
			</tr>
		</thead>

		<tbody>
		@foreach($roles as $role)
			<tr>
				<td>{{ $role->name }}</td>
				<td>{{ $role->display_name }}</td>
				<td>{{ $role->description }}</td>
				<td class="text-xs-center">
					@include('admin.manage._singleActions', [
						'editUrl' => route('admin.manage.roles.edit', [$role]),
						'deleteUrl' => route('admin.manage.roles.destroy', [$role]),
					])
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
