<div class="row">
	<div class="col-xs-1 form-group">
		{{ Form::label('is_public', trans('admin.manage.activities.form.isPublicLabel')) }}
		{{ Form::hidden('is_public', 0) }} {{ Form::checkbox('is_public') }}
	</div>

	<div class="col-xs-11 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		{{ Form::label('name', trans('admin.manage.activities.form.nameLabel')) }}
		{{ Form::text('name', null, [ 'class' => 'form-control' ]) }}
	</div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
	{{ Form::label('description', trans('admin.manage.activities.form.descriptionLabel')) }}
	{{ Form::textarea('description', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
	{{ Form::label('location', trans('admin.manage.activities.form.locationLabel')) }}
	{{ Form::text('location', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="row">
	<div class="col-md-6 form-group{{ $errors->has('start') ? ' has-error' : '' }}">
		{{ Form::label('start', trans('admin.manage.activities.form.startLabel')) }}
		{{ Form::input('datetime-local', 'start', null, [ 'class' => 'form-control' ]) }}
	</div>

	<div class="col-md-6 form-group{{ $errors->has('end') ? ' has-error' : '' }}">
		{{ Form::label('end', trans('admin.manage.activities.form.endLabel')) }}
		{{ Form::input('datetime-local', 'end', null, [ 'class' => 'form-control' ]) }}
	</div>
</div>

<div class="row">
	<div class="col-md-6 form-group{{ $errors->has('subscription_start') ? ' has-error' : '' }}">
		{{ Form::label('subscription_start', trans('admin.manage.activities.form.subscriptionStartLabel')) }}
		{{ Form::input('datetime-local', 'subscription_start', null, [ 'class' => 'form-control' ]) }}
	</div>

	<div class="col-md-6 form-group{{ $errors->has('subscription_end') ? ' has-error' : '' }}">
		{{ Form::label('subscription_end', trans('admin.manage.activities.form.subscriptionEndLabel')) }}
		{{ Form::input('datetime-local', 'subscription_end', null, [ 'class' => 'form-control' ]) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('organizer_list', trans('admin.manage.activities.form.organizersLabel')) }}
	{{ Form::select('organizer_list[]', $organizers, null, [
			'multiple', 'id' => 'organizer_list', 'class' => 'form-control'
	]) }}
</div>

<div class="form-group">
	{{ Form::label('tag_list', trans('admin.manage.activities.form.tagsLabel')) }}
	{{ Form::select('tag_list[]', $tags, null, [
			'multiple', 'id' => 'tag_list', 'class' => 'form-control'
	])}}
</div>

<div class="form-group">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary btn-block' ]) }}
</div>

@if ($errors->any())
	<ul>
	@foreach ($errors as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
@endif

@push('scripts')
	<script>
		$('#tag_list').select2();
		$('#organizer_list').select2();
	</script>
@endpush
