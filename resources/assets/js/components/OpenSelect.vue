<template>
	<span class="input-group">
		<select ref="select" :class="selectClass" @change="onSelectChanged">
			<slot></slot>
		</select>
		<input ref="input" v-show="otherSelected" class="form-control"
		       :name="name" type="text" :required="required"
		       v-model:value="submitValue">
	</span>
</template>

<style lang="scss" scoped>
	.input-group-addon {
		max-width: 40%;
	}
</style>

<script>
	export default {
		props: {
			name: {
				type: String,
				required: true,
			},
			value: {
				type: String,
			},
			other: {
				type: String,
				default: 'other',
			},
			required: {
				type: Boolean,
				default: false,
			},
		},
		data: function() {
			return {
				otherSelected: false,
				submitValue: this.value,
			};
		},
		computed: {
			selectClass: function() {
				return this.otherSelected ? 'input-group-addon' : 'form-control';
			},
		},
		mounted: function() {
			this.setSubmitValue(this.$refs.select.value);
		},
		updated: function() {
			if (this.otherSelected)
				this.$refs.input.focus();
		},
		methods: {
			setSubmitValue: function(value) {
				if (value === this.other) {
					this.otherSelected = true;
					this.submitValue = this.value;
				} else {
					this.submitValue = value;
					this.otherSelected = false;
				}
			},
			onSelectChanged: function(event) {
				this.setSubmitValue(event.target.value);
			},
		},
	};
</script>
