import Vue from 'vue';
import Vuex from 'vuex';

import listings from './modules/Listing';
import loginUser from './modules/Login';

Vue.use(Vuex);

// eslint-disable-next-line import/prefer-default-export
export const store = new Vuex.Store({
  modules: {
    listings,
    loginUser,
  },
});
