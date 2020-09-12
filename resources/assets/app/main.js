import Vue from 'vue';
import VueRouter from 'vue-router';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import router from './router';
import App from './App.vue';

// Install BootstrapVue
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);
// Vue Router
Vue.use(VueRouter);

Vue.config.productionTip = false;

// eslint-disable-next-line no-unused-vars
const app = new Vue({
  el:         '#app',
  components: { App },
  router,
});
