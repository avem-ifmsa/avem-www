<div class="form-group">
	{{ Form::label('name', trans('admin.manage.roles.form.nameLabel')) }}
	{{ Form::text('name', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="form-group">
	{{ Form::label('display_name', trans('admin.manage.roles.form.displayNameLabel')) }}
	{{ Form::text('display_name', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="form-group">
	{{ Form::label('description', trans('admin.manage.roles.form.descriptionLabel')) }}
	{{ Form::text('description', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="form-group">
	{{ Form::label('perm_list', trans('admin.manage.roles.form.permissionsLabel')) }}
	{{ Form::select('perm_list[]', $permissions, null, [
			'class' => 'form-control',
			'id' => 'perm_list',
			'multiple',
		]) }}
</div>

<div class="form-group">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary btn-block' ]) }}
</div>

@push('scripts')
	<script>
		$('#perm_list').select2();
	</script>
@endpush
