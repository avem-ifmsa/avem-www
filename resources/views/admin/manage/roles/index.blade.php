@extends('admin.manage.roles.panel')

@section('main')
	<table class="table table-hover table-compact">
		<tr>
			<th>{{ trans('admin.manage.roles.index.name') }}</th>
			<th>{{ trans('admin.manage.roles.index.displayName') }}</th>
			<th>{{ trans('admin.manage.roles.index.description') }}</th>
			<th>
				@include('admin.manage.actions.global', [
					'createUrl' => route('admin.manage.roles.create'),
				])
			</th>
		</tr>
		@foreach($roles as $role)
			<tr>
				<td>{{ $role->name }}</td>
				<td>{{ $role->display_name }}</td>
				<td>{{ $role->description }}</td>
				<td>
					@include('admin.manage.actions.local', [
						'editUrl' => route('admin.manage.roles.edit', [$role]),
						'deleteUrl' => route('admin.manage.roles.destroy', [$role]),
					])
				</td>
			</tr>
		@endforeach
	</table>
@endsection
