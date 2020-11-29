/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('buildings-component', require('./components/buildings/Buildings-Component.vue').default);
Vue.component('buildings-create-component', require('./components/buildings/Buildings-Create-Component.vue').default);
Vue.component('elevators-component', require('./components/elevators/Elevators-Component.vue').default);
Vue.component('elevators-create-component', require('./components/elevators/Elevators-Create-Component.vue').default);
Vue.component('managers-component', require('./components/managers/Managers-Component.vue').default);
Vue.component('managers-create-component', require('./components/managers/Managers-Create-Component.vue').default);

const app = new Vue({
    el: '#app',
});



