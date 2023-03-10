import './bootstrap';
import Vue from 'vue';
import axios from 'axios';
import App from './App.vue'
import router from './router'
import VModal from 'vue-js-modal'

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
Vue.use(VModal)