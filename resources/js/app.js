/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Notifications from 'vue-notification'

window.Vue = require('vue').default;

window.Vue.use(Notifications)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('list-component', require('./components/ListProductoComponent.vue').default);
Vue.component('form-component', require('./components/FormProductoComponent.vue').default);
Vue.component('star-component', require('./components/StarComponent.vue').default);
Vue.component('detail-component', require('./components/DetailProductoComponent.vue').default);
Vue.component('calification-component', require('./components/CalificationProductoComponent.vue').default);
Vue.component('stock-component', require('./components/StockProductoComponent.vue').default);
Vue.component('delete-component', require('./components/DeleteProductoComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
