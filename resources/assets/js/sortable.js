function delegateEvent(event, selector, callback) {
	var eventTarget = event.target;
	var currentTarget = event.currentTarget;
	while (eventTarget != currentTarget) {
		if (eventTarget.matches && eventTarget.matches(selector)) {
			return callback(eventTarget, event);
		} else {
			eventTarget = eventTarget.parentElement;
		}
	}
}

function onSortableItemDragStart(event) {
	event.target.classList.add('is-dragging');
	event.dataTransfer.effectAllowed = 'move';
	event.dataTransfer.setData('text/html', event.target.id);
}

function onSortableItemDragEnd(event) {
	event.target.classList.remove('is-dragging');
}

function onSortableItemDragEnter(event) {
	delegateEvent(event, '.sortable-item,.sortable-area', dragTarget => {
		dragTarget.classList.add('is-hovered');
	});
}

function onSortableItemDragOver(event) {
	delegateEvent(event, '.sortable-item,.sortable-area', dragTarget => {
		event.preventDefault();
	});
}

function onSortableItemDragLeave(event) {
	delegateEvent(event, '.sortable-item,.sortable-area', dragTarget => {
		dragTarget.classList.remove('is-hovered');
	});
}

function onSortableItemDrop(event) {
	delegateEvent(event, '.sortable-item', dropTarget => {
		var sortableList = dropTarget.parentElement;
		var itemId = event.dataTransfer.getData('text/html');
		var item = document.getElementById(itemId);
		if (dropTarget.classList.contains('sortable-area--before')) {
			sortableList.insertBefore(item, dropTarget.nextSibling);
		} else {
			sortableList.insertBefore(item, dropTarget);
		}
		dropTarget.classList.remove('is-hovered');
		event.stopPropagation();
	});
}

document.addEventListener('DOMContentLoaded', () => {
	var sortableElements = document.querySelectorAll('.sortable');
	for (var i = 0; i < sortableElements.length; i++) {
		sortableElements[i].addEventListener('dragstart', onSortableItemDragStart);
		sortableElements[i].addEventListener('dragend'  , onSortableItemDragEnd  );
		sortableElements[i].addEventListener('dragenter', onSortableItemDragEnter);
		sortableElements[i].addEventListener('dragover' , onSortableItemDragOver );
		sortableElements[i].addEventListener('dragleave', onSortableItemDragLeave);
		sortableElements[i].addEventListener('drop'     , onSortableItemDrop     )
	}
});
