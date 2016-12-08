<script>
	var domain = "{{config('laravel-auth0.domain')}}";
	var clientId = "{{config('laravel-auth0.client_id')}}";
	var lock = new Auth0Lock(clientId, domain, {
		auth: {
			redirectUrl: "{{config('laravel-auth0.redirect_uri')}}",
			responseType: 'code',
			params: {
				scope: 'openid email name',
			},
		},
		container: "{{$container}}",
		initialScreen: "{{$initialScreen}}",
		language: 'es',
	});
	lock.show();
</script>
