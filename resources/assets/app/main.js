import Vue from 'vue';
import VueRouter from 'vue-router';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

import App from './views/App.vue';
import Hello from './views/Hello.vue';
import Home from './views/Home.vue';

// Install BootstrapVue
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);
// Vue Router
Vue.use(VueRouter);

const router = new VueRouter({
  mode:   'history',
  routes: [
    {
      path:      '/',
      name:      'home',
      component: Home,
    },
    {
      path:      '/hello',
      name:      'hello',
      component: Hello,
    },
  ],
});

// eslint-disable-next-line no-unused-vars
const app = new Vue({
  el:         '#app',
  components: { App },
  router,
});
