import axios from 'axios';
import loginModule from '../modules/User';

const state = {
  listings: [],
  errors:   [],
};

const actions = {
  async showAllListings({ commit }, paginated) {
    const data = await axios.get('/api/listings', {
      headers: {
        Authorization: `Bearer ${loginModule.state.token}`,
      },
      params: paginated,
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

  async detailListing({ commit }, id) {
    const data = await axios.get(`/api/listings/${id}`)
      .then(res => res.data)
      .catch(error => {
        commit('GET_ERROR', error.response.data.errors);
      });

    return data;
  },

  async updateApproveListing({ commit }, id) {
    await axios.post(`/api/listings/${id}/approve`, {}, {
      headers: {
        Authorization: `Bearer ${loginModule.state.token}`,
      },
    })
      .then(res => {
        console.log(res.data);
      })
      .catch(error => {
        commit('GET_ERROR', error.response.data.errors);
      });
  },
  async addCommentListing({ commit }, comments) {
    const data = await axios.post('/api/comments', comments, {
      headers: {
        Authorization: `Bearer ${loginModule.state.token}`,
      },
    })
      .then(res => {
        // const listings = res.data;

        console.log(res.data);

        return res.data;
      })
      .catch(error => {
        commit('GET_ERROR', error.response.data.errors);
      });

    return data;
  },

  async getCommentsListing({ commit }, id) {
    const data = await axios.get(`/api/listings/${id}/comments`, {
      headers: {
        Authorization: `Bearer ${loginModule.state.token}`,
      },
    })
      .then(res => res.data.results)
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
