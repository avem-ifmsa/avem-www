<template>
	<input type="text" @input="onInput" v-model:value="value">
</template>

<script>
	export default {
		props: ['target', 'confirm'],
		data: function() {
			return {
				value: '',
				wasEnabled: false,
			};
		},
		computed: {
			isEnabled: function() {
				return this.value === this.confirm;
			},
			onInput: function() {
				if (this.isEnabled !== this.wasEnabled) {
					const target = document.querySelector(this.target);
					if (target != null) {
						this.isEnabled ? target.classList.remove('disabled')
						               : target.classList.add('disabled');
						this.wasEnabled = this.isEnabled;
					}
				}
			}
		},
	};
</script>
