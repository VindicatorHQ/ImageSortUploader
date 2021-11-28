/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import { createApp } from 'vue';
import axios from 'axios';
import VueAxios from "vue-axios";
require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const VueApp = createApp({
    mounted() {
        console.log("Vue Initialized")
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/DesktopNav.vue -> <example-component></example-component>
 */

VueApp.component('Navigation', require('./components/Navigation.vue').default);
VueApp.component("ShowImages", require('./components/ShowImages.vue').default);
VueApp.component("ShowImage", require('./components/ShowImage.vue').default);
VueApp.component("Home", require('./components/Home.vue').default);

VueApp.use(VueAxios, axios);
VueApp.mount('#app');
