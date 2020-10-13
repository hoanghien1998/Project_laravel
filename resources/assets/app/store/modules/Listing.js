import axios from 'axios';

const state = {
  listings: [],
  errors:   [],
};

const actions = {
  async showAllListings({ commit }, paginated) {
    const data = await axios.get(`/api/listings?per_page=${paginated.per_page}&page=${paginated.page}&model_id=${paginated.model_id}&make_id=${paginated.make_id}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('auth')}`,
      },
    })
      .then(res => {
        const listings = res.data;

        commit('SET_LISTING', listings);

        return listings;
      })
      .catch(error => {
        commit('GET_ERROR', error.response.data.errors);
      });

    return data;
  },
};

const mutations = {
  SET_LISTING(state, listings) {
    state.listings = listings;
  },
  GET_ERROR(state, errors) {
    state.errors.push(errors);
  },
};

const getters = {
  getListings: state => state.listings,
};

// eslint-disable-next-line import/prefer-default-export
export default {
  namespaced: true,
  state,
  actions,
  mutations,
  getters,
};
