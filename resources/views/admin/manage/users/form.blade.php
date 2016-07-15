<div class="form-group">
	{{ Form::label('email', trans('admin.manage.users.form.emailLabel')) }}
	{{ Form::email('email', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="form-group">
	{{ Form::label('password', trans('admin.manage.users.form.passwordLabel')) }}
	{{ Form::password('password', [ 'class' => 'form-control' ]) }}
</div>

<div class="form-group">
	{{ Form::label('role_list', trans('admin.manage.users.form.rolesLabel')) }}
	{{ Form::select('role_list[]', $roles, null, [
			'class' => 'form-control',
			'id' => 'role_list',
			'multiple',
	]) }}
</div>

<div class="form-group">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary btn-block' ]) }}
</div>

@push('scripts')
	<script>
		$('#role_list').select2();
	</script>
@endpush
