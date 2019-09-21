import router from './router.js';
require('./bootstrap');
require('./../sass/app.scss');

window.Vue = require('vue');



const app = new Vue({
    el: '#app',
    router: router
});
