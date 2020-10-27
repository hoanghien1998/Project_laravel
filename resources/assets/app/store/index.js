import Vue from 'vue';
import Vuex from 'vuex';

import listings from './modules/Listing';
import users from './modules/User';
import fitter from './modules/Fitter';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

// eslint-disable-next-line import/prefer-default-export
export default new Vuex.Store({
  modules: {
    users,
    listings,
    fitter,
  },
  strict: debug,
});
