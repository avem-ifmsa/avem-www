<div class="row">
	<div class="col-md-6 form-group">
		{{ Form::label('name', trans('admin.manage.mbCharges.form.nameLabel')) }}
		{{ Form::text('name', null, [ 'class' => 'form-control' ]) }}
	</div>

	<div class="col-md-6 form-group">
		{{ Form::label('email', trans('admin.manage.mbCharges.form.emailLabel')) }}
		{{ Form::email('email', null, [ 'class' => 'form-control' ]) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('description', trans('admin.manage.mbCharges.form.descriptionLabel')) }}
	{{ Form::textarea('description', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="form-group">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary btn-block' ]) }}
</div>
