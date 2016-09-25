@extends('layouts.app')

@section('title')
	{{ trans('auth.register.title') }}
@endsection

@section('content')
	<div class="col-md-6 offset-md-3">
		<div class="card-block">
			{{ Form::open([ 'url' => '/register' ]) }}
				<!--Header-->
				<div class="text-xs-center p-b-1">
					<h3><i class="fa fa-user"></i> {{ trans('auth.register.header') }}</h3>
					<hr class="m-t-2 m-b-2">
				</div>

				<!--Body-->
				<div class="row">
					<div class="col-md-5">
						<div class="md-form">
							<i class="fa fa-user prefix"></i>
							{{ Form::text('first_name', old('first_name'), [ 'class' => 'form-control' ]) }}
							{{ Form::label('first_name', trans('auth.registerMember.firstName')) }}
						</div>
					</div>

					<div class="col-md-7">
						<div class="md-form">
							{{ Form::text('last_name', old('last_name'), [ 'class' => 'form-control' ]) }}
							{{ Form::label('last_name', trans('auth.registerMember.lastName')) }}
						</div>
					</div>
				</div>

				<div class="md-form">
					<i class="fa fa-envelope prefix"></i>
					{{ Form::email('email', old('email'), [ 'class' => 'form-control' ]) }}
					{{ Form::label('email', trans('auth.register.email')) }}
				</div>

				<div class="md-form">
					<i class="fa fa-lock prefix"></i>
					{{ Form::password('password', [ 'class' => 'form-control' ]) }}
					{{ Form::label('password', trans('auth.register.password')) }}
				</div>

				<div class="md-form">
					<i class="fa fa-check prefix"></i>
					{{ Form::password('password_confirmation', [ 'class' => 'form-control' ]) }}
					{{ Form::label('password_confirmation', trans('auth.register.passwordConfirm')) }}
				</div>

				<div class="text-xs-center">
					<button class="btn btn-indigo">{{ trans('auth.register.registerButton') }}</button>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@endsection
