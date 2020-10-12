import axios from 'axios';

const state = {
  token: localStorage.getItem('auth') || '',
};

const actions = {
  // eslint-disable-next-line no-unused-vars
  loginUser({ commit }, token) {
    axios.post('api/auth', token)
      .then(res => {
        // eslint-disable-next-line no-unused-vars,prefer-destructuring
        const token = res.data.token;

        commit('setToken', token);
      });
  },
};
const mutations = {
  setToken(state, token) {
    localStorage.setItem('auth', token);
    state.token = token;
  },
  clearToken(state) {
    localStorage.removeItem('auth');
    state.token = '';
  },
};

// eslint-disable-next-line import/prefer-default-export
export default {
  namespaced: true,
  state,
  actions,
  mutations,
};

