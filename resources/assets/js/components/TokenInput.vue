<template>
	<ul ref="tokenList" class="list-unstyled" @click.self="onTokenListClick">
		<li v-if="isPlaceholderShown" class="token-placeholder">
			<span>{{ this.placeholder }}</span>
		</li>

		<li ref="tokenItems" v-for="(token, i) of tokens" :key="token"
		    @keydown.self="onTokenItemKeyDown(i, $event)"
		    class="token-existing" tabindex="0">
			<span v-if="isTokenInEditMode(i)">
				<input ref="editTokenInputs" type="text" :value="token" :list="list"
				       @blur="onEditTokenInputBlur" @input="onTokenInputInput"
				       @keydown.self="onEditTokenInputKeyDown(i, $event)"
				       v-model="editTokenContent">
			</span>

			<span v-else @click.self="selectToken(i)" @dblclick="onTokenItemDoubleClick(i)">
				<p>{{ token }}</p>
				<button type="button" tabindex="-1" @click="removeToken(i)">&times;</button>
			</span>
		</li>

		<li class="token-new">
			<input ref="newTokenInput" type="text" :list="list"
			       @keydown="onNewTokenInputKeyDown"
			       @input="onTokenInputInput"
			       v-model="newTokenContent">
		</li>

		<input ref="tokenListValue" type="hidden" :name="name" :value="inputValue">
	</ul>
</template>

<style scoped lang="scss">
	ul {
		margin: 0;
		padding: 4px 3px;

		display: inline-flex;
		flex-wrap: wrap;

		cursor: text;
	}

	li {
		margin: 2px;
		outline: none;
		padding: 3px 8px;

		font-weight: 600;
		white-space: nowrap;
		overflow: hidden;

		&.token-existing {
			border-radius: 4px;
			border: 1px solid #c3c3c3;

			cursor: pointer;
			background-color: #f7f7f7;

			p {
				margin: 0;
				padding: 0;
				display: inline-block;
			}

			button {
				border: none;
				padding: 1px;
				margin-left: 5px;

				color: inherit;
				background-color: inherit;

				cursor: pointer;
			}

			&:focus {
				background-color: #fefbc6;
			}
		}

		&.token-new {
			display: inline-block;
			margin: 3px 2px;
		}
	}

	input {
		padding: 0;
		border: none;
		outline: none;

		width: 20px;
		min-width: 2px;

		&::-webkit-calendar-picker-indicator {
			display: none;
		}
	}

	.token-placeholder {
		position: absolute;

		color: #b1b7ba;
		font-weight: normal;
		pointer-events: none;
		font-family: sans-serif;
	}
</style>

<script>
	import textWidth from 'text-width';

	export default {
		props: [
			'name', 'value', 'list', 'placeholder',
		],
		data: function() {
			return {
				newTokenContent: '',
				editTokenContent: '',
				editTokenIndex: null,
				tokens: this.value ? this.value.split(',').map(t => t.trim()) : [],
			};
		},
		computed: {
			inputValue: function() {
				return this.tokens.join(',');
			},
			isPlaceholderShown: function() {
				return this.tokens.length == 0 && this.newTokenContent == '';
			},
		},
		methods: {
			getComputedTokenWidth: function(inputElement) {
				var inputStyle = getComputedStyle(inputElement);
				return textWidth(inputElement.value, {
					size: inputStyle.getPropertyValue("font-size"),
					family: inputStyle.getPropertyValue("font-family"),
				}) + 10;
			},
			isTokenInEditMode: function(index) {
				return index === this.editTokenIndex;
			},
			onTokenListClick: function() {
				this.$refs.newTokenInput.focus();
			},
			onTokenItemKeyDown: function(index, event) {
				switch (event.key) {
				case 'ArrowLeft':
					if (index > 0)
						this.$refs.tokenItems[index - 1].focus();
					break;
				case 'ArrowRight':
					var tokenItems = this.$refs.tokenItems;
					if (index < tokenItems.length - 1)
						tokenItems[index + 1].focus();
					else
						this.$refs.newTokenInput.focus();
					break;
				case 'Backspace': case 'Delete':
					this.tokens.splice(index, 1);
					Vue.nextTick(() => {
						var tokenItems = this.$refs.tokenItems;
						if (index < tokenItems.length) {
							this.$refs.tokenItems[index].focus();
						} else {
							this.$refs.newTokenInput.focus();
						}
					});
					break;
				default:
					var tokenItem = event.target;
					tokenItem.blur();
					break;
				}
			},
			onTokenItemDoubleClick: function(index) {
				this.editTokenIndex = index;
				this.editTokenContent = this.tokens[index];
				Vue.nextTick(() => {
					var tokenInput = this.$refs.editTokenInputs[0];
					var tokenWidth = this.getComputedTokenWidth(tokenInput);
					tokenInput.style.width = `${tokenWidth}px`;
					tokenInput.select();
				});
			},
			onEditTokenInputBlur: function(event) {
				this.editTokenIndex = null;
			},
			onEditTokenInputKeyDown: function(index, event) {
				switch (event.key) {
				case 'Enter':
					event.preventDefault();
					var tokenInput = event.target;
					if (this.editTokenContent !== '') {
						this.tokens.splice(index, 1, this.editTokenContent);
					} else {
						this.tokens.splice(index, 1);
					}
					this.editTokenIndex = null;
					this.editTokenContent = '';
					tokenInput.style.width = null;
					break;
				case 'Escape':
					this.editTokenIndex = null;
					this.editTokenContent = '';
					this.$refs.tokenInput.focus();
					break;
				}
			},
			onNewTokenInputKeyDown: function(event) {
				switch (event.key) {
				case 'Enter':
					if (this.newTokenContent !== '') {
						event.preventDefault();
						var tokenInput = event.target;
						this.tokens.push(this.newTokenContent);
						tokenInput.style.width = null;
						this.newTokenContent = '';
					}
					break;
				case 'ArrowLeft':
					if (this.newTokenContent === '') {
						var tokenItems = this.$refs.tokenItems;
						if (tokenItems.length > 0)
							tokenItems[tokenItems.length - 1].focus();
					}
					break;
				case 'Backspace':
					if (this.newTokenContent === '') {
						if (this.tokens.length > 0)
							this.tokens.splice(this.tokens.length - 1, 1);
					}
					break;
				}
			},
			onTokenInputInput: function(event) {
				var tokenInput = event.target;
				var tokenWidth = this.getComputedTokenWidth(tokenInput);
				tokenInput.style.width = `${tokenWidth}px`;
			},
			removeToken: function(index) {
				this.tokens.splice(index, 1);
			},
			selectToken: function(index) {
				this.$refs.tokenItems[index].focus();
			},
		},
	};
</script>
