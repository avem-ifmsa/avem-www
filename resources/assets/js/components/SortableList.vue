<style scoped>
	[draggable="true"] {
		cursor: move;
	}
</style>

<script>
	export default {
		data: function() {
			return {
				items: [], order: [],
				draggedItem: null,
			};
		},
		created: function() {
			const children = this.$slots.default || [];
			this.items = children.filter(x => x.tag === 'li');
			this.order = Array.from(Array(this.items.length).keys());
			for (let i = 0; i < this.items.length; ++i) {
				this.items[i].key = i;
			}
		},
		computed: {
			orderedItems: function() {
				return this.order.map(x => this.items[x]);
			},
		},
		methods: {
			findItemIndex: function(item) {
				return this.items.findIndex(x => {
					return x.elm.isEqualNode(item);
				});
			},
			onItemDragStart: function(event) {
				const {target} = event;
				this.draggedItem = target;
				target.classList.add('is-dragging');
				event.dataTransfer.effectAllowed = 'move';
			},
			onDragEnterItem: function(event) {
				const {target} = event;
				if (!this.draggedItem.isEqualNode(target))
					target.classList.add('is-hovered');
			},
			onDragOverItem: function(event) {
				if (!event.target.isEqualNode(this.draggedItem)) {
					event.dataTransfer.dropEffect = 'move';
					event.preventDefault();
					return false;
				}
			},
			onDragLeaveItem: function(event) {
				const {target} = event;
				if (!this.draggedItem.isEqualNode(target))
					target.classList.remove('is-hovered');
			},
			onItemDragEnd: function(event) {
				event.target.classList.remove('is-dragging');
				this.draggedItem = null;
			},
			onItemDrop: function(event) {
				const {target} = event;
				const dropIndex = this.findItemIndex(target);
				const dragIndex = this.findItemIndex(this.draggedItem);
				this.order.splice(this.order.indexOf(dragIndex), 1);
				this.order.splice(this.order.indexOf(dropIndex) - 1, 0, dragIndex);
				target.classList.remove('is-hovered');
				event.preventDefault();
				return false;
			},
			onItemDropAfter: function(event) {
				const dragIndex = this.findItemIndex(this.draggedItem);
				this.order.splice(this.order.indexOf(dragIndex), 1);
				this.order.push(dragIndex);
				event.target.classList.remove('is-hovered');
				event.preventDefault();
				return false;
			},
		},
		render: function(h) {
			return h('div', [
				h('ol', {
					on: {
						dragstart: this.onItemDragStart,
						dragenter: this.onDragEnterItem,
						dragleave: this.onDragLeaveItem,
						dragover: this.onDragOverItem,
						dragend: this.onItemDragEnd,
						drop: this.onItemDrop,
					},
				}, this.orderedItems),
				h('span', {
					style: {
						display: 'block',
						height: '20px',
					},
					on: {
						dragenter: this.onDragEnterItem,
						dragover: this.onDragOverItem,
						dragleave: this.onDragLeaveItem,
						drop: this.onItemDropAfter,
					},
				}),
			]);
		},
	};
</script>
