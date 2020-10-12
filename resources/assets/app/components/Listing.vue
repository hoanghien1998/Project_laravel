<template>
  <div class="container">
    <b-table :items="getListings"
             :current-page="currentPage"
             hover
             bordered/>
    <b-pagination v-model="currentPage"
                  :total-rows="total"
                  :per-page="paginated.per_page"
                  prev-text="Prev"
                  next-text="Next"
                  @change="handlePageChange"
    />
  </div>
</template>

<script>
export default {
  data() {
    return {
      total:     0,
      paginated: {
        page:     10,
        per_page: 30,
      },
      currentPage: '2',
    };
  },
  computed: {
    getListings() {
      const listings = this.$store.getters['listings/getListings'];

      if (listings.pagination && listings.pagination.total) {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.total = listings.pagination.total;
      }

      return listings.results;
    },

    // currentPage: {
    //   get() {
    //     return this.$route.query.page || 1;
    //   },
    //   set(newPage) {
    //     // You could alternatively call your API here if you have serverside pagination
    //
    //     this.$router
    //       .push({ query: { ...this.$route.query, page: newPage } })
    //       .catch(() => {});
    //   },
    // },
  },
  created() {
    this.showListings();
  },
  methods: {
    showListings() {
      console.log(this.paginated);
      this.paginated.page = this.$route.query.page || 1;
      console.log(this.paginated);

      const paginationObj = {
        page:     this.$route.query.page,
        per_page: 6,
      };

      this.$store
        .dispatch('listings/showAllListings', paginationObj).finally(() => {
          this.$router
            .push({ query: { ...this.$route.query, page: paginationObj.page } })
            .catch(() => {});
        });
    },
    handlePageChange() {
      // this.showListings();
    },
  },

};
</script>

<style>

</style>
