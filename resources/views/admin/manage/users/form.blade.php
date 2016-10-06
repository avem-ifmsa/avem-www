<div class="md-form">
	{{ Form::label('email', trans('admin.manage.users.form.emailLabel')) }}
	{{ Form::email('email', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="md-form">
	{{ Form::label('password', trans('admin.manage.users.form.passwordLabel')) }}
	{{ Form::password('password', [ 'class' => 'form-control' ]) }}
</div>

<div class="md-form">
	{{ Form::label('role_list', trans('admin.manage.users.form.rolesLabel')) }}
	{{ Form::select('role_list[]', $roles, old('role_list'), [
			'id' => 'role_list', 'multiple',
			'class' => 'form-control',
	]) }}
</div>

<div class="md-form text-xs-center">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary' ]) }}
</div>
