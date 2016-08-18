<div class="form-group">
	{{ Form::label('member', trans('admin.manage.mbMembers.form.memberLabel')) }}
	{{ Form::select('member', $members, [
			'id' => 'member', 'class' => 'form-control'
	]) }}
</div>

<div class="row">
	<div class="col-md-6 form-group">
		{{ Form::label('dni_nif', trans('admin.manage.mbMembers.form.dniNifLabel')) }}
		{{ Form::text('dni_nif', null, [ 'class' => 'form-control' ]) }}
	</div>

	<div class="col-md-6 form-group">
		{{ Form::label('phone', trans('admin.manage.mbMembers.form.phoneLabel')) }}
		{{ Form::text('phone', null, [ 'class' => 'form-control' ]) }}
	</div>
</div>

<div class="form-group">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary btn-block' ]) }}
</div>

@push('scripts')
	<script>
		$('#member').select2();
	</script>
@endpush
