<form action="{{ $url }}" method="post">
	{{ method_field($method) }}
	{{ csrf_field() }}
	<button type="submit">
		{!! $slot !!}
	</button>
</form>
