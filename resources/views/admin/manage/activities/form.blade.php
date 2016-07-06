<div class="form-group">
	{{ Form::label('name', trans('admin.manage.activities.form.nameLabel')) }}
	{{ Form::text('name', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="form-group">
	{{ Form::hidden('is_public', false) }}
	{{ Form::label('is_public', trans('admin.manage.activities.form.isPublicLabel')) }}
	{{ Form::checkbox('is_public', null) }}
</div>

<div class="form-group">
	{{ Form::label('description', trans('admin.manage.activities.form.descriptionLabel')) }}
	{{ Form::textarea('description', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="form-control">
	{{ Form::label('location', trans('admin.manage.activities.form.locationLabel')) }}
	{{ Form::text('location', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="row">
	<div class="form-group col-md-6">
		{{ Form::label('start', trans('admin.manage.activities.form.startLabel')) }}
		{{ Form::text('start', null, [
				'type' => 'datetime-local', 'class' => 'form-control'
		]) }}
	</div>

	<div class="form-group col-md-6">
		{{ Form::label('end', trans('admin.manage.activities.form.endLabel')) }}
		{{ Form::text('end', null, [
				'type' => 'datetime-local', 'class' => 'form-control'
		]) }}
	</div>
</div>

<div class="row">
	<div class="form-group col-md-6">
		{{ Form::label('subscription_start',
		               trans('admin.manage.activities.form.subscriptionStartLabel')) }}
		{{ Form::text('subscription_start', null, [
				'type' => 'datetime-local', 'class' => 'form-control'
		]) }}
	</div>

	<div class="form-group col-md-6">
		{{ Form::label('subscription_end',
		               trans('admin.manage.activities.form.subscriptionEndLabel')) }}
		{{ Form::text('subscription_end', null, [
				'type' => 'datetime-local', 'class' => 'form-control'
		]) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('organizer_list', trans('admin.manage.activities.form.organizersLabel')) }}
	{{ Form::select('organizer_list[]', $organizers, null, [
			'multiple', 'id' => 'organizer_list', 'class' => 'form-control'
	]) }}
</div>

<div class="form-group">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary btn-block' ]) }}
</div>

@push('scripts')
	<script>
		$('#organizer_list').chosen({ width: '100%' });
	</script>
@endpush
