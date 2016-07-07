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
		{{ Form::label('gender', trans('admin.manage.members.form.genderLabel')) }}
		{{ Form::select('gender', [
				null => trans('admin.manage.members.form.genderOptions.notApplicable'),
				'male' =>  trans('admin.manage.members.form.genderOptions.male'),
				'female' =>  trans('admin.manage.members.form.genderOptions.female'),
				'other' => trans('admin.manage.members.form.genderOptions.other'),
			], null, [ 'id' => 'gender', 'class' => 'form-control']) }}
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
		$('#gender').select2();
	</script>
@endpush
