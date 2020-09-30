// import { userService } from '../../services/user.service';
import axios from 'axios';

const state = {
  users:  [],
  token:  '',
  errors: [],
};

const actions = {
  createUser({ commit }, user) {
    axios.post('/api/register', user)
      .then(res => {
        // eslint-disable-next-line prefer-destructuring
        const token = res.data.token;

        commit('ADD_USER', { user, token });
      })
      .catch(error => {
        commit('GET_ERROR', error.response.data.errors);
      });
  },
};

const mutations = {
  ADD_USER(state, { user, token }) {
    state.users.push(user);
    state.token = token;
  },
  GET_ERROR(state, errors) {
    state.errors.push(errors);
  },
};

const getters = {
  getToken: state => state.token,
  getError: state => state.errors[0],
};

// eslint-disable-next-line import/prefer-default-export
export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
};
