@extends('main.home')

@push('scripts')
	<script>
		function toggleNewsletterSubscription() {
			$('#settings-toggle-newsletter-form').submit();
		}
	</script>
@endpush

@section('home-content')
	<section class="card p-4">
		<h3>Datos personales</h3>
		<form action="{{ route('home.settings.save') }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}

			<div class="mx-auto mb-2 my-md-4 profile-photo">
				<input class="rounded-circle" type="file" name="photo" is="input-image"
				       placeholder="{{ old('photo', $user->profileImageUrl) }}">
			</div>

			<div class="row">
				<p class="col-md-4 form-group form-group--required{{ $errors->has('name') ? ' has-danger' : '' }}">
					<label for="settings-name">Nombre</label>
					<input id="settings-name" class="form-control" type="text" required
					       name="name" value="{{ old('name', $user->name) }}">
					@if ($errors->has('name'))
						<span class="form-text">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				</p>

				<p class="col-md-8 form-group form-group--required{{ $errors->has('surname') ? ' has-danger' : '' }}">
					<label for="settings-surname">Apellidos</label>
					<input id="settings-surname" class="form-control" type="text" required
					       name="surname" value="{{ old('surname', $user->surname) }}">
					@if ($errors->has('surname'))
						<span class="form-text">
							<strong>{{ $errors->first('surname') }}</strong>
						</span>
					@endif
				</p>
			</div>

			<div class="row">
				<p class="col-md-6 form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
					<label for="settings-gender">Género</label>
					<select is="open-select" input-id="settings-gender" name="gender" value="{{ old('gender') }}">
						<option value=""       {{  old('gender', $user->gender) == ''       ? 'selected' : '' }}>Prefiero no decirlo</option>
						<option value="male"   {{  old('gender', $user->gender) == 'male'   ? 'selected' : '' }}>Hombre</option>
						<option value="female" {{  old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Mujer</option>
						<option value="other"  {{ (old('gender', $user->gender) != 'male'
						                        && old('gender', $user->gender) != 'female'
						                        && old('gender', $user->gender) != null)    ? 'selected' : '' }}>Otro</option>
					</select>
				</p>

				<p class="col-md-6 form-group{{ $errors->has('birthday') ? ' has-danger' : '' }}">
					<label for="settings-birthday">Cumpleaños</label>
					<input id="settings-birthday" class="form-control" type="date" name="birthday"
					       value="{{ old('birthday', $user->birthday ? $user->birthday->format('Y-m-d') : '') }}">
					@if ($errors->has('birthday'))
						<span class="form-text">
							<strong>{{ $errors->first('birthday') }}</strong>
						</span>
					@endif
				</p>
			</div>

			<p class="form-group form-group--required{{ $errors->has('email') ? ' has-danger' : '' }}">
				<label for="settings-email">Dirección de correo-e</label>
				<input id="settings-email" class="form-control" type="email" required
				name="email" value="{{ old('email', $user->email) }}">
				@if ($errors->has('email'))
					<span class="form-text">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			</p>

			<p class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
				<label for="settings-password">Contraseña</label>
				<input id="settings-password" class="form-control" type="password" name="password">
				@if ($errors->has('password'))
					<span class="form-text">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
			</p>

			<div class="mt-md-4">
				<button type="submit" role="button" class="btn btn-primary">
					Guardar cambios
				</button>
			</div>
		</form>
	</section>

	<section class="mt-3 card p-3">
		<a name="newsletter"></a>

		<h3>Recibir correos</h3>

		<form id="settings-toggle-newsletter-form" method="post" action="{{
			route(!$user->isSubscribedToNewsletter ? 'newsletter.subscribe'
			                                       : 'newsletter.unsubscribe')
		}}">{{ csrf_field() }}</form>

		<div class="mt-2">
			@if (Session::has('newsletterError'))
				<div class="alert alert-warning">
					{{ Session::get('newsletterError') }}
				</div>
			@endif

			<label class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input" {{
					$user->isSubscribedToNewsletter ? 'checked' : ''
				}} onchange="toggleNewsletterSubscription()">

				<span class="custom-control-indicator"></span>
				<span class="custom-control-description">
					Deseo recibir correos de AVEM con información relacionada con la Asociación,
					información de próximas actividades y eventos.
				</span>
			</label>
		</div>
	</section>

	<section class="mt-3 card p-3">
		<h3>Eliminar cuenta</h3>

		<p>
			Esta acción eliminará su cuenta <strong>de forma permanente</strong>.
			Esta acción no puede deshacerse. Por favor, asegúrate de que esto
			es lo que quieres antes de continuar.
		</p>

		<div>
			<!-- dummy div to avoid .card applying .btn-block to button children -->
			<a role="button" class="btn btn-danger" href="{{ route('account.delete') }}">
				Eliminar cuenta
			</a>
		</div>
	</section>
@stop
