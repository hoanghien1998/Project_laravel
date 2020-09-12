import Vue from 'vue';
import Router from 'vue-router';

import Login from './views/Login.vue';
import Signup from './views/Signup.vue';
import ForgotPassword from './views/ForgotPassword.vue';
import About from './views/About.vue';
import Home from './views/Home.vue';

Vue.use(Router);

export default new Router({
  mode:   'history',
  routes: [
    {
      path:      '/',
      name:      'home',
      component: Home,
    },
    {
      path:      '/about',
      name:      'about',
      component: About,
    },
    {
      path:      '/auth',
      name:      'auth',
      component: Login,
      meta:      {
        layout: 'auth',
      },
    },
    {
      path:      '/signup',
      name:      'signup',
      component: Signup,
      meta:      {
        layout: 'auth',
      },
    },
    {
      path:      '/forgot-password',
      name:      'forgot-password',
      component: ForgotPassword,
      meta:      {
        layout: 'auth',
      },
    },
    {
      path: '*',
      name: 'Error',
      meta: {
        layout: 'error',
      },
    },
  ],
});
