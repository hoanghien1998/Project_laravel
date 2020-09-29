import Vue from 'vue';
import VueRouter from 'vue-router';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faUser, faKey } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import router from './router';
import App from './App.vue';

library.add(faUser);
library.add(faKey);
Vue.component('font-awesome-icon', FontAwesomeIcon);

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

