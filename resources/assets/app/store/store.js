import Vue from 'vue';
import Vuex from 'vuex';

import loginUser from './modules/Login';
import users from './modules/User';

Vue.use(Vuex);

// eslint-disable-next-line import/prefer-default-export
export const store = new Vuex.Store({
  modules: {
    loginUser,
    users,
  },
});
