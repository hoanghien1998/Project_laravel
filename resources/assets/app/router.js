import Vue from 'vue';
import Router from 'vue-router';

import Login from './views/Login.vue';
import Signup from './views/Signup.vue';
import ForgotPassword from './views/ForgotPassword.vue';
import About from './views/About.vue';
import Home from './views/Home.vue';
import DetailListing from './views/DetailListing.vue';
import Listing from './views/admin/Listing.vue';

Vue.use(Router);

const ifNotAuthenticated = (to, from, next) => {
  if (!localStorage.getItem('auth')) {
    next();

    return;
  }
  next('/');
};

const ifAuthenticated = (to, from, next) => {
  if (localStorage.getItem('auth')) {
    next();

    return;
  }

  next('/auth');
};

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
      beforeEnter: ifNotAuthenticated,
    },
    {
      path:      '/signup',
      name:      'signup',
      component: Signup,
      meta:      {
        layout: 'auth',
      },
      beforeEnter: ifNotAuthenticated,
    },
    {
      path:      '/forgot-password',
      name:      'forgot-password',
      component: ForgotPassword,
      meta:      {
        layout: 'auth',
      },
      beforeEnter: ifNotAuthenticated,
    },
    {
      path:        '/admin/listings',
      name:        'admin-listing',
      component:   Listing,
      beforeEnter: ifAuthenticated,
    },
    {
      path: '*',
      name: 'Error',
      meta: {
        layout: 'error',
      },
    },
    {
      path:      '/detail-listing',
      name:      'detailListing',
      component: DetailListing,
    },
  ],
});
