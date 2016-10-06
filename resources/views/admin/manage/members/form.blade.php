<div class="row">
	<div class="col-md-4">
		<div class="md-form">
			{{ Form::label('first_name', trans('admin.manage.members.form.firstNameLabel')) }}
			{{ Form::text('first_name', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>

	<div class="col-md-8">
		<div class="md-form">
			{{ Form::label('last_name', trans('admin.manage.members.form.lastNameLabel')) }}
			{{ Form::text('last_name', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('user', trans('admin.manage.members.form.userLabel')) }}
			{{ Form::select('user', $users, null, [
					'id' => 'user', 'class' => 'form-control'
				]) }}
		</div>
	</div>

	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('birthday', trans('admin.manage.members.form.birthdayLabel')) }}
			{{ Form::date('birthday', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>
</div>

<div class="md-form text-xs-center">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary' ]) }}
</div>
