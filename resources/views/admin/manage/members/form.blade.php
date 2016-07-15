<div class="row">
	<div class="col-md-4 form-group">
		{{ Form::label('first_name', trans('admin.manage.members.form.firstNameLabel')) }}
		{{ Form::text('first_name', null, [ 'class' => 'form-control' ]) }}
	</div>

	<div class="col-md-8 form-group">
		{{ Form::label('last_name', trans('admin.manage.members.form.lastNameLabel')) }}
		{{ Form::text('last_name', null, [ 'class' => 'form-control' ]) }}
	</div>
</div>

<div class="row">
	<div class="form-group col-md-6">
		{{ Form::label('user', trans('admin.manage.members.form.userLabel')) }}
		{{ Form::select('user', $users, null, [
				'id' => 'user', 'class' => 'form-control'
		]) }}
	</div>

	<div class="form-group col-md-6">
		{{ Form::label('birthday', trans('admin.manage.members.form.birthdayLabel')) }}
		{{ Form::date('birthday', null, [ 'class' => 'form-control' ]) }}
	</div>
</div>

<div class="form-group">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary btn-block' ]) }}
</div>

@push('scripts')
	<script>
		$('#user').select2();
	</script>
@endpush
