export function delegateEvent(event, selector, callback) {
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
