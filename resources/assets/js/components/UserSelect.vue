<template>
	<div ref="root" class="root" @focusout="onComponentFocusOut">
		<button v-if="!isActivated" class="form-control" @click="activateControl">
			<slot :user="selectedUser"></slot>
			<button v-if="selectedUser" class="clear-user"
			        @click.stop="clearSelectedUser">
				<i class="fa fa-times"></i>
			</button>
		</button>

		<input v-else type="search" class="form-control"
		       ref="filterInput" v-model="filterText"
		       @keydown.enter="selectFirstUserIfUnique"
		       @keydown.esc="deactivateControl"
		       @input="invalidateUsers">

		<input type="hidden" :name="name" :value="submitValue">

		<div v-if="isActivated" class="option-container">
			<ul v-if="userResultsNotReady" class="not-ready">
				<li>
					<i class="fa fa-spin fa-refresh"></i>
					Buscando usuarios que coincidan con su búsqueda
				</li>
			</ul>

			<ul v-else-if="thereWasAnError" class="request-error">
				<li>
					<i class="fa fa-times"></i>
					Hubo un error durante la búsqueda de usuarios.
				</li>
			</ul>

			<ul v-else-if="noMatchingUsers" class="not-available">
				<li>
					<i class="fa fa-times"></i>
					Ningún usuario coincide con su búsqueda.
				</li>
			</ul>

			<ul v-else class="user-results">
				<li v-for="user of filteredUsers" :key="user.id"
				    tabindex="0" @click="selectUser(user)">
					<slot :user="user"></slot>
				</li>
			</ul>
		</div>
	</div>
</template>

<style scoped lang="scss">
	.root {
		display: inline-block;
		position: relative;
	}

	.option-container {
		position: absolute;
		width: 100%;
		top: 100%;
	}

	button {
		cursor: pointer;
	}

	.clear-user {
		top: 50%;
		right: 5%;
		position: absolute;
		transform: translateY(-50%);

		color: #aaa;
		border: none;
		outline: none;
		background-color: transparent;

		&:hover {
			color: #000;
		}
	}

	ul {
		margin-left: 0;
		list-style: none;
		padding: 5px 0px;

		background-color: #fff;
	}

	li {
		padding: 3px 20px;

		cursor: default;
	}

	.not-ready i, .request-error i, .not-available i {
		margin-right: 10px;
	}

	.user-results {
		li:hover {
			background-color: #f5f5f5;
		}
	}
</style>

<script>
	export default {
		props: [
			"name", "value",
		],
		data: function() {
			return {
				filterText: "",
				isActivated: false,
				requestError: null,
				selectedUser: this.value,
			};
		},
		computed: {
			userResultsNotReady: function() {
				return this.filteredUsers === null;
			},
			thereWasAnError: function() {
				return this.requestError !== null;
			},
			noMatchingUsers: function() {
				return this.filteredUsers.length === 0;
			},
			submitValue: function() {
				return this.selectedUser ? this.selectedUser.id : null;
			},
		},
		asyncComputed: {
			filteredUsers: function() {
				return axios.get(`/api/search/users?q=${this.filterText}`)
				            .then(response => response.data)
				            .catch(e => { this.requestError = e; });
			},
		},
		methods: {
			activateControl: function() {
				this.isActivated = true;
				Vue.nextTick(() => {
					this.$refs.filterInput.focus();
				});
			},
			clearSelectedUser: function() {
				this.selectedUser = null;
			},
			deactivateControl: function() {
				this.isActivated = false;
			},
			invalidateUsers: function() {
				this.requestError = null;
				this.filteredUsers = null;
			},
			onComponentFocusOut: function(event) {
				if (this.isActivated) {
					Vue.nextTick(() => {
						var rootElement = this.$refs.root;
						var focusElement = event.relatedTarget || document.activeElement;
						if (!rootElement.contains(focusElement))
							this.deactivateControl();
					});
				}
			},
			selectFirstUserIfUnique: function() {
				if (this.filteredUsers.length === 1)
					this.selectUser(this.filteredUsers[0]);
			},
			selectUser: function(user) {
				this.selectedUser = user;
				this.isActivated = false;
			},
		},
	};
</script>