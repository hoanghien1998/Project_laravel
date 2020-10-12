import axios from 'axios';

// eslint-disable-next-line import/prefer-default-export
export default {
  async showAllListings(paginated) {
    const resp = await axios.get(
      '/api/listings', {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('auth')}`,
        },
      },
      paginated
    );

    return resp.data;
  },
};
