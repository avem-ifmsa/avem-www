<div class="row">
	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('name', trans('admin.manage.mbCharges.form.nameLabel')) }}
			{{ Form::text('name', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>

	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('email', trans('admin.manage.mbCharges.form.emailLabel')) }}
			{{ Form::email('email', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>
</div>

<div class="md-form">
	{{ Form::label('description', trans('admin.manage.mbCharges.form.descriptionLabel')) }}
	{{ Form::textarea('description', null, [ 'class' => 'md-textarea' ]) }}
</div>

<div class="md-form text-xs-center">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary' ]) }}
</div>
