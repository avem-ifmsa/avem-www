@extends('admin.manage.roles.panel')

@section('panel')
	<table class="table table-hover table-compact">
		<thead>
			<tr>
				<th>{{ trans('admin.manage.roles.index.name') }}</th>
				<th>{{ trans('admin.manage.roles.index.displayName') }}</th>
				<th>{{ trans('admin.manage.roles.index.description') }}</th>
				<th>
					@include('admin.actions.manageGlobal', [
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
				<td>
					@include('admin.actions.manageLocal', [
						'editUrl' => route('admin.manage.roles.edit', [$role]),
						'deleteUrl' => route('admin.manage.roles.destroy', [$role]),
					])
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@endsection
