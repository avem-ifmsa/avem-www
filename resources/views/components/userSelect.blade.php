<user-select class="w-100" {{ isset($name)     ? "name=$name"        : '' }}
                           {{ isset($value)    ? ":value=$value"     : '' }}
                           {{ isset($onchange) ? "@change=$onchange" : '' }}>
	<template scope="data">
		<div v-if="data.user" class="user-result">
			<img class="user-image" :src="data.user.profileImageUrl">
			<span class="user-info">
				<span class="user-name">@{{ data.user.fullName }}</span>
				<span class="user-email">@{{ data.user.email }}</span>
			</span>
		</div>

		<span v-else>
			@if (isset($placeholder))
				{{ $placeholder }}
			@else
				Seleccione un usuario
			@endif
		</span>
	</template>
</user-select>
