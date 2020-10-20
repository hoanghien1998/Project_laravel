import axios from 'axios';
import router from '../../router';

const state = {
  users:  [],
  token:  localStorage.getItem('auth') || '',
  status: '',
  error:  [],
};

const actions = {
  createUser({ commit }, user) {
    axios.post('/api/register', user)
      .then(res => {
        // eslint-disable-next-line prefer-destructuring
        const token = res.data.token;

        commit('ADD_USER', { user, token });
        router.push('/');
      })
      .catch(error => {
        commit('GET_ERROR', error.response.data.errors);
      });
  },
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
  ADD_USER(state, { user, token }) {
    state.users.push(user);
    localStorage.setItem('auth', token);
    state.token = token;
  },
  GET_ERROR(state, errors) {
    state.errors.push(errors);
  },
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

const getters = {
  getToken:        state => state.token,
  getError:        state => state.errors[0],
  isAuthenticated: state => !!state.token,
  authStatus:      state => state.status,
};

// eslint-disable-next-line import/prefer-default-export
export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
};
