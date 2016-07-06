{{ Form::open(['url' => $deleteUrl, 'method' => 'delete']) }}
	<div class="form-group btn-group">
		<a href="{{ $editUrl }}" class="btn btn-default btn-sm">
			<span class="glyphicon glyphicon-edit"></span>
			{{ trans('admin.manage.actions.editButton') }}
		</a>
		<button type="submit" class="btn btn-danger btn-sm">
			<span class="glyphicon glyphicon-remove"></span>
			{{ trans('admin.manage.actions.deleteButton') }}
		</button>
	</div>
{{ Form::close() }}
