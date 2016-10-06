<div class="md-form">
	{{ Form::label('member', trans('admin.manage.mbMembers.form.memberLabel')) }}
	{{ Form::select('member', $members, [
			'id' => 'member', 'class' => 'form-control'
	]) }}
</div>

<div class="row">
	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('dni_nif', trans('admin.manage.mbMembers.form.dniNifLabel')) }}
			{{ Form::text('dni_nif', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>

	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('phone', trans('admin.manage.mbMembers.form.phoneLabel')) }}
			{{ Form::text('phone', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>
</div>

<div class="md-form text-xs-center">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary' ]) }}
</div>
