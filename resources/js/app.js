/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
window.Vue = require('vue').default;

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Swal from 'sweetalert2';
import axios from 'axios';

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('login-component', require('./components/LoginComponent.vue').default);
Vue.component('register-component', require('./components/RegisterComponentModal.vue').default);
Vue.component('job-modal-component', require('./components/AddJobComponentModal.vue').default);
Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
Vue.component('update-job-component', require('./components/UpdateJobComponentModal.vue').default);
Vue.component('view-job-details-component', require('./components/ViewJobDetailsComponentModal.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
