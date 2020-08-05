/*import ViewComponent from './components/ViewComponent.vue';
import App from './App.vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import EditComponent from './components/EditComponent.vue'
import CreateComponent from './components/CreateComponent.vue'
import Vue from 'vue'
import './bootstrap'
import router from './router'




 
//Toaster for message
import Toaster from 'v-toaster'
 
// You need a specific loader for CSS files like https://github.com/webpack/css-loader
import 'v-toaster/dist/v-toaster.css'
 
// optional set default imeout, the default is 10000 (10 seconds).
Vue.use(Toaster, {timeout: 1000});
 
//sweet alert
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);
 
//import vue-router
import VueRouter from 'vue-router';
Vue.use(VueRouter);
 
//import vue-axios
import VueAxios from 'vue-axios';
 
import axios from 'axios';
 
Vue.use(VueAxios, axios);
 
Vue.use(Vuetify);

// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
Vue.use(VueAuth, auth)
 
//top-progress bar
import vueTopprogress from 'vue-top-progress'
Vue.use(vueTopprogress);
 
const routes = [
 
    
    {
        path: '/view',
        name: 'view',
        component: ViewComponent,
    },

    {
        path: '/create',
        name: 'create',
        component: CreateComponent,
    },

    {
        path: '/edit/:id',
        name: 'edit',
        component: EditComponent,
    },
];

 
const router = new VueRouter({
    mode: 'history',
    routes: routes,
    root:  '/'
}); 
 
// Vue.router = router;
// App.router = Vue.router;
 
// initialize vue instance

/*new Vue({
  el: '#app',
  router
});
 
new Vue({
    el: '#app',
    router,
    render: h => h(App),
});*/


import 'es6-promise/auto'
import axios from 'axios'
import './bootstrap'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './Index'
import auth from './auth'
import router from './router'
// Set Vue globally
window.Vue = Vue
// Set Vue router
Vue.router = router
Vue.use(VueRouter)
// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
Vue.use(VueAuth, auth)
// Load Index
Vue.component('index', Index)
const app = new Vue({
  el: '#app',
  router
});