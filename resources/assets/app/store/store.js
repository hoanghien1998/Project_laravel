import Vue from 'vue';
import Vuex from 'vuex';

import listings from './modules/Listing';

Vue.use(Vuex);

// eslint-disable-next-line import/prefer-default-export
export const store = new Vuex.Store({
  modules: {
    listings,
  },
  state: {
    token: localStorage.getItem('auth') || '',
  },
  mutations: {
    setToken(state, token) {
      localStorage.setItem('auth', token);
      state.token = token;
    },
    clearToken(state) {
      localStorage.removeItem('auth');
      state.token = '';
    },
  },
});
