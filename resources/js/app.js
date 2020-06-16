/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import router from './router';
import vuetify from './plugins/vuetify';
import Vuelidate from 'vuelidate';
import Meta from 'vue-meta';
import { TiptapVuetifyPlugin } from 'tiptap-vuetify'
import 'tiptap-vuetify/dist/main.css';


import wysiwyg from "vue-wysiwyg";
import "vue-wysiwyg/dist/vueWysiwyg.css";
window.$ = window.jQuery = require('jquery');
Vue.use(wysiwyg, {
    image: {
    uploadURL: "/api/upload-image",
    dropzoneOptions: {
        maxFilesize: 4,
        acceptedFiles: 'image/*',        
       headers: {

           "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
       }
    }
  }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component('app-component', require('./components/AppComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 // Vue.use(VueRouter);

 Vue.use(TiptapVuetifyPlugin, {
  // the next line is important! You need to provide the Vuetify Object to this place.
  vuetify, // same as "vuetify: vuetify"
  // optional, default to 'md' (default vuetify icons before v2.0.0)
  iconsGroup: 'mdi'
});

Vue.use(Meta, {
    keyName: 'metaInfo',
    attribute: 'data-vue-meta',
    tagIDKeyName: 'vmid',
    refreshOnceOnNavigation: true
});

Vue.use(require('vue-moment'));

const app = new Vue({
    vuetify,
    router,
}).$mount('#app');
