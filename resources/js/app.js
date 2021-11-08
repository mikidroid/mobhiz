/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = vue;
/*Imports*/
import vue from 'vue';
import Entry from './components/EntryPoint.vue';
import AdminEntry from './components/AdminEntry.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import Vuex from 'vuex';
import {store} from './store/store';
import {adminstore} from './store/adminstore';
import { BSpinner } from 'bootstrap-vue';
import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import vuetify from './vuetify';
import VoerroTagsInput from '@voerro/vue-tagsinput';
import Pagination from 'vue-pagination-2';
import JwPagination from 'jw-vue-pagination';
import cons from './components/config/const.js';
import { VueEditor } from "vue2-editor";

Vue.config.productionTip = false;

/*Uses*/

axios.defaults.withCredentials = true;
//window.axios.defaults.baseURL = "mobhiz.com.ng";
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Vuex);
Vue.use(VueSweetalert2);

/* Components */
Vue.component('jw-pagination', JwPagination);
Vue.component('vue-editor', VueEditor);
Vue.component('tags-input', VoerroTagsInput);
Vue.component('pagination', Pagination);
Vue.component('sidenav1', require('./components/nav/sidenav1.vue').default);
Vue.component('nav-modal', require('./components/core/modals/nav-modal.vue').default);
Vue.component('loader', require('./components/core/loader.vue').default);
Vue.component('search', require('./components/core/search.vue').default);
Vue.component('b-spinner', BSpinner);
/*Router*/
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.AdminAccess)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (!localStorage.getItem('token')) {
      next({
        path: '/login',
        query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } else {
    next() // make sure to always call next()!
  }
})


/*Main app initialize*/
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(Entry),
    store:store,
    vuetify
});
/* Admin initialize*/
