<div class="row">
	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('name', trans('admin.manage.permissions.form.nameLabel')) }}
			{{ Form::text('name', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>

	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('display_name', trans('admin.manage.permissions.form.displayNameLabel')) }}
			{{ Form::text('display_name', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>
</div>

<div class="md-form">
	{{ Form::label('description', trans('admin.manage.permissions.form.descriptionLabel')) }}
	{{ Form::text('description', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="md-form text-xs-center">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary' ]) }}
</div>
