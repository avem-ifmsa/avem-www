@extends('layouts.main')

@section('title')
    {{ trans('auth.register.title') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('auth.register.header') }}
                </div>

                <div class="panel-body">
                    {{ Form::open([ 'url' => '/register', 'class' => 'form-horizontal' ]) }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            {{ Form::label('first_name', trans('auth.registerMember.firstName'), [ 'class' => 'col-md-4 control-label' ]) }}
                            <div class="col-md-6">
                                {{ Form::text('first_name', old('first_name'), [ 'class' => 'form-control' ]) }}
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            {{ Form::label('last_name', trans('auth.registerMember.lastName'), [ 'class' => 'col-md-4 control-label' ]) }}
                            <div class="col-md-6">
                                {{ Form::text('last_name', old('last_name'), [ 'class' => 'form-control']) }}
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', trans('auth.register.email'), [ 'class' => 'col-md-4 control-label' ]) }}
                            <div class="col-md-6">
                                {{ Form::email('email', old('email'), [ 'class' => 'form-control' ]) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            {{ Form::label('birthday', trans('auth.registerMember.birthday'), [ 'class' => 'col-md-4 control-label' ]) }}
                            <div class="col-md-6">
                                {{ Form::date('birthday', old('birthday'), [ 'class' => 'form-control' ]) }}
                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::label('password', trans('auth.register.password'), [ 'class' => 'col-md-4 control-label' ]) }}
                            <div class="col-md-6">
                                {{ Form::password('password', [ 'class' => 'form-control' ]) }}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {{ Form::label('password_confirmation', trans('auth.register.passwordConfirm'), [ 'class' => 'col-md-4 control-label' ]) }}
                            <div class="col-md-6">
                                {{ Form::password('password_confirmation', [ 'class' => 'form-control' ])}}
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>
                                    {{ trans('auth.register.registerButton') }}
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
