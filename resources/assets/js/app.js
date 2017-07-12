/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust , powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueAsyncComputed);

Vue.component('input-image'  , require('./components/InputImage.vue'  ));
Vue.component('open-select'  , require('./components/OpenSelect.vue'  ));
Vue.component('sortable-list', require('./components/SortableList.vue'));
Vue.component('token-input'  , require('./components/TokenInput.vue'  ));
Vue.component('user-select'  , require('./components/UserSelect.vue'  ));

document.addEventListener('DOMContentLoaded', function() {
	const app = new Vue({
		el: '#app'
	});
});
