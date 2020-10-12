import Vue from 'vue';
import Vuex from 'vuex';

import loginUsers from './modules/Login';

Vue.use(Vuex);

// eslint-disable-next-line import/prefer-default-export
export const store = new Vuex.Store({
  modules: {
    loginUsers,
  },
});
