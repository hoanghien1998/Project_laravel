import axios from 'axios';
import router from '../../router';


const state = {
  token:  localStorage.getItem('auth') || '',
  status: '',
  error:  [],
};

const getters = {
  isAuthenticated: state => !!state.token,
  authStatus:      state => state.status,
};
const actions = {
  // eslint-disable-next-line no-unused-vars
  async loginUser({ commit }, token) {
    const data = await axios.post('api/auth', token)
      .then(res => {
        // eslint-disable-next-line no-unused-vars,prefer-destructuring
        const token = res.data.token;

        commit('setToken', token);
        router.push('/');

        return token;
      }).catch(error => {
        commit('clearToken', token);

        return error.response.data;
      });

    return data;
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
  loginFail(state, loginErrors) {
    state.error = loginErrors;
  },
};

// eslint-disable-next-line import/prefer-default-export
export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
};

