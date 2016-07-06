<div class="form-group">
	{{ Form::label('name', trans('admin.manage.permissions.form.nameLabel')) }}
	{{ Form::text('name', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="form-group">
	{{ Form::label('display_name', trans('admin.manage.permissions.form.displayNameLabel')) }}
	{{ Form::text('display_name', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="form-group">
	{{ Form::label('description', trans('admin.manage.permissions.form.descriptionLabel')) }}
	{{ Form::text('description', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="form-group">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-block btn-primary' ]) }}
</div>
