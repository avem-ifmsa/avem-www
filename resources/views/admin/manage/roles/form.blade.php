<div class="row">
	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('name', trans('admin.manage.roles.form.nameLabel')) }}
			{{ Form::text('name', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>

	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('display_name', trans('admin.manage.roles.form.displayNameLabel')) }}
			{{ Form::text('display_name', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>
</div>

<div class="md-form">
	{{ Form::label('description', trans('admin.manage.roles.form.descriptionLabel')) }}
	{{ Form::textarea('description', null, [ 'class' => 'md-textarea' ]) }}
</div>

<div class="md-form">
	{{ Form::label('perm_list', trans('admin.manage.roles.form.permissionsLabel')) }}
	{{ Form::select('perm_list[]', $permissions, null, [
			'class' => 'form-control',
			'id' => 'perm_list',
			'multiple',
		]) }}
</div>

<div class="md-form text-xs-center">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary' ]) }}
</div>
