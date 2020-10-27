import axios from 'axios';

const state = {
  carMakes: [],
};

const getters = {

};

const actions = {
  loadCarMakes({ commit }) {
    return axios.get('api/cars/makes')
      .then(res => {
        commit('SET_CAR_MAKES', res.data.results);
      });
  },
};

const mutations = {
  SET_CAR_MAKES(state, carMakes) {
    state.carMakes = carMakes;
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
