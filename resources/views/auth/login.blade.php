@extends('layouts.main')

@section('title')
    {{ trans('auth.login.title') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('auth.login.header') }}
                </div>

                <div class="panel-body">
                    {{ Form::open([ 'url' => '/login', 'class' => 'form-horizontal']) }}

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('warning'))
                            <div class="alert alert-warning">
                                {{ session('warning') }}
                            </div>
                        @endif

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', trans('auth.login.email'), [ 'class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::email('email', old('email'), [ 'class' => 'form-control' ]) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::label('password', trans('auth.login.password'), [ 'class' => 'col-md-4 control-label' ]) }}
                            <div class="col-md-6">
                                {{ Form::password('password', [ 'class' => 'form-control' ]) }}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('remember', null) }}
                                        {{ trans('auth.login.rememberMe') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>
                                    {{ trans('auth.login.loginButton') }}
                                </button>

                                {{ Html::link('/password/reset',
                                              trans('auth.login.forgotPassword'),
                                              [ 'class' => 'btn btn-link' ]) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
