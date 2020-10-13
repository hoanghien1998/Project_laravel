<template>
  <div class="container">
    <b-form-select
      v-model="selected"
      :options="per_page"
      class="per_page"
      @change="handlePerpageChange"/>
    <b-table id="my-table"
             ref="table"
             :items="items"
             hover
             bordered />
    <b-pagination v-if="total > 0"
                  v-model="page"
                  :total-rows="total"
                  :per-page="perPage"
                  align="center"
                  prev-text="Prev"
                  next-text="Next"
                  @change="handlePageChange"

    />

  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex';

const { mapGetters, mapActions } = createNamespacedHelpers('listings');

export default {
  name: 'ListingComponent',
  data() {
    return {
      total:    0,
      page:     0,
      perPage:  0,
      selected: 30,
      per_page: [
        { value: 30, text: 30 },
        { value: 60, text: 60 },
        { value: 90, text: 90 },
      ],
    };
  },
  computed: {
    ...mapGetters([
      'getListings',
    ]),
    items() {
      return this.getListings.results;
    },
  },
  async created() {
    this.page = this.$route.query.page || 1;
    this.perPage = this.$route.query.per_page || 30;
    this.selected = this.perPage;
    console.log(this.perPage);
    await this.initPage();
  },
  methods: {
    ...mapActions(['showAllListings']),
    async handlePageChange(value) {
      await this.replaceUrl(value, 'page');
      await this.$refs.table.refresh();
    },
    async handlePerpageChange(value) {
      await this.replaceUrl(value, 'per_page');
      await this.$refs.table.refresh();
    },
    async initPage() {
      const data = await this.showAllListings({
        page:     this.page,
        per_page: this.perPage,
      });

      this.total = data.pagination.total;
      this.page = data.pagination.current_page;
    },
    getPage() {
      return this.$route.query.page || 1;
    },
    async replaceUrl(value, type) {
      if (type === 'page') {
        this.page = value;
        this.$router
          .push({ query: { ...this.$route.query, page: this.page } })
          .catch(() => {});
      }

      if (type === 'per_page') {
        this.perPage = value;
        this.$router
          .push({ query: { ...this.$route.query, per_page: this.perPage } })
          .catch(() => {});
      }

      await this.showAllListings({
        page:     this.page,
        per_page: this.perPage,
      });
    },
  },

};
</script>

<style>
.per_page{
  width: 10%;
}
</style>
