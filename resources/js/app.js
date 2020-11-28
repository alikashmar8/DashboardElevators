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
Vue.component('buildings-component', require('./components/Buildings-Component.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        newBuilding: {'name': '', 'address': '', 'floors': 0, 'contactNumber': ''},
        hasError: true,
        cars: [],
    },
    methods: {
        createBuilding: function createBuilding() {
            var input = this.newBuilding;
            var _this = this;
            // if(input['make'] == '' || input['model'] == '') {
            //     this.hasError = false;
            // }
            this.hasError = true;
            axios.get('http://127.0.0.1:8000/buildings', input).then(function (response) {
                console.log("sent");
                console.log(response);
                _this.newBuilding = {'name': '', 'address': '', 'floors': 0, 'contactNumber': ''}
            }).catch(error => {
                console.log("Insert: " + error);
            });

        },
    }
});



