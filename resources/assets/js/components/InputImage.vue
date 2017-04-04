<template>
	<label>
		<img :src="imageUrl" @load="onImageLoad">
		<input ref="fileInput" :alt="alt" :name="name" type="file"
		       :required="required" accept="image/*" v-show="false"
		       @change="onFileChange">
	</label>
</template>

<style scoped lang="scss">
	label {
		width: 100%;
		height: 100%;
		display: block;
		position: relative;

		&:hover::before {
			color: #fff;
			padding: 15px;
			cursor: pointer;
			box-sizing: border-box;
			border-radius: inherit;
			background-color: rgba(150, 150, 150, .5);

			z-index: 10;
			width: 100%;
			height: 100%;
			position: absolute;

			display: flex;
			text-align: center;
			align-items: center;
			justify-content: center;

			font-size: 1.5em;
			font-weight: bold;
			font-family: sans-serif;
			content: 'Cargar imagen';
			text-transform: uppercase;
		}
	}

	img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		border-radius: inherit;
	}
</style>

<script>
	export default {
		props: [ 'alt', 'name', 'value', 'required', 'placeholder' ],
		data: function() {
			return {
				value: null,
			};
		},
		computed: {
			imageUrl: function() {
				return this.value || this.placeholder;
			},
		},
		methods: {
			onFileChange: function(event) {
				const {files} = this.$refs.fileInput;
				this.value = URL.createObjectURL(files[0]);
			},
			onImageLoad: function(event) {
				if (this.value !== null)
					URL.revokeObjectURL(this.value);
			},
		},
	};
</script>
