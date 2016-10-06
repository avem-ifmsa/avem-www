<div class="row">
	<div class="col-xs-1">
		<fieldset class="form-group">
			{{ Form::label('is_public', trans('admin.manage.activities.form.isPublicLabel')) }}
			{{ Form::hidden('is_public', 0) }} {{ Form::checkbox('is_public', null, [ 'class' => 'filled-in' ]) }}
		</fieldset>
	</div>

	<div class="col-xs-11">
		<div class="md-form">
			{{ Form::label('name', trans('admin.manage.activities.form.nameLabel')) }}
			{{ Form::text('name', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>
</div>

<div class="md-form">
	{{ Form::label('description', trans('admin.manage.activities.form.descriptionLabel')) }}
	{{ Form::textarea('description', null, [ 'class' => 'md-textarea' ]) }}
</div>

<div class="md-form">
	{{ Form::label('location', trans('admin.manage.activities.form.locationLabel')) }}
	{{ Form::text('location', null, [ 'class' => 'form-control' ]) }}
</div>

<div class="row">
	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('start', trans('admin.manage.activities.form.startLabel')) }}
			{{ Form::input('datetime-local', 'start', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>

	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('end', trans('admin.manage.activities.form.endLabel')) }}
			{{ Form::input('datetime-local', 'end', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('subscription_start', trans('admin.manage.activities.form.subscriptionStartLabel')) }}
			{{ Form::input('datetime-local', 'subscription_start', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>

	<div class="col-md-6">
		<div class="md-form">
			{{ Form::label('subscription_end', trans('admin.manage.activities.form.subscriptionEndLabel')) }}
			{{ Form::input('datetime-local', 'subscription_end', null, [ 'class' => 'form-control' ]) }}
		</div>
	</div>
</div>

<div class="md-form">
	{{ Form::label('organizer_list', trans('admin.manage.activities.form.organizersLabel')) }}
	{{ Form::select('organizer_list[]', $organizers, null, [
			'multiple', 'id' => 'organizer_list', 'class' => 'form-control'
	]) }}
</div>

<div class="md-form">
	{{ Form::label('tag_list', trans('admin.manage.activities.form.tagsLabel')) }}
	{{ Form::select('tag_list[]', $tags, null, [
			'multiple', 'id' => 'tag_list', 'class' => 'form-control',
	])}}
</div>

<div class="md-form text-xs-center">
	{{ Form::submit($submitLabel, [ 'class' => 'btn btn-primary' ]) }}
</div>

@if ($errors->any())
	<ul>
	@foreach ($errors as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
@endif
