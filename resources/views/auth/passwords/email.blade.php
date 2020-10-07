@extends('layouts.auth')

@section('content')
	<div class="mt-4 col-md-6 offset-md-3">
		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif

		<form method="post" action="{{ route('password.email') }}">
			{{ csrf_field() }}

			<p class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
				<label for="email-email">Dirección de correo-e</label>
				<input id="email-email" class="form-control" name="email"
				       type="email" value="{{ old('email') }}" required>
				@if ($errors->has('email'))
					<span class="form-text">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			</p>

			<p>
				<button class="btn btn-primary" type="submit" role="button">Enviar enlace al correo</button>
				
			</p>
		</form>
	</div>
@stop
