<template>
	<label class="input-image">
		<img :src="imageUrl" @load="onImageLoad">
		<input ref="fileInput" :alt="alt" :name="name" type="file"
		       :required="required" accept="image/*" v-show="false"
		       @change="onFileChange">
	</label>
</template>

<style lang="scss" scoped>
	.input-image {
		border: none;
		display: block;
		position: relative;

		img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			border-radius: inherit;
		}

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
			font-family: sans-serif;
			content: 'Cargar imagen';
			text-transform: uppercase;
		}
	}
</style>

<script>
	export default {
		props: [ 'alt', 'name', 'required', 'placeholder' ],
		data: function() {
			return {
				image: null,
			};
		},
		computed: {
			imageUrl: function() {
				return this.image || this.placeholder;
			},
		},
		methods: {
			onFileChange: function(event) {
				const {files} = this.$refs.fileInput;
				this.image = URL.createObjectURL(files[0]);
			},
			onImageLoad: function(event) {
				if (this.image !== null)
					URL.revokeObjectURL(this.image);
			},
		},
	};
</script>
