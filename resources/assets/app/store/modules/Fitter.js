import axios from 'axios';

const state = {
  carMakes: [],
};

const actions = {
  async loadCarMakes({ commit }) {
    const res = await axios.get('/api/cars/makes');

    console.log(res.data);

    const carMakes = res.data;

    carMakes.forEach(c => {
      // eslint-disable-next-line no-param-reassign
      c.state_ids = c.states.map(p => p.id);
    });
    commit('SET_CAR_MAKES', carMakes);

    console.log(res.data);

    return res;
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
};
