import axios from 'axios';

const state = {
  listings: [],
  errors:   [],
};

const actions = {
  showAllListings({ commit }, paginated) {
    console.log(paginated);
    axios.get(`/api/listings?per_page=${paginated.per_page}&page=${paginated.page}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('auth')}`,
      },
      params: {
        paginated,
      },
    })
      .then(res => {
        const listings = res.data;

        commit('SET_LISTING', listings);
      })
      .catch(error => {
        commit('GET_ERROR', error.response.data.errors);
      });
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
