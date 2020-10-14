<template>
  <div class="container">
    <b-form-select
      v-model="paginatied.per_page"
      :options="per_page"
      class="per_page"
      @change="handlePerpageChange"/>
    <b-table
      :items="items"
      :fields="fields"
      hover
      bordered >
      <template v-slot:cell(action)="row">
        <b-button size="sm"
                  class="mr-2">
          Details
        </b-button>
      </template>
    </b-table>
    <b-pagination v-if="total > 0"
                  v-model="paginatied.page"
                  :total-rows="total"
                  :per-page="paginatied.per_page"
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
      total:      0,
      paginatied: {
        page:     0,
        per_page: 0,
        model_id: 0,
        make_id:  0,
      },
      fields:   [ 'id', 'car_model_id', 'car_trim_id', 'year', 'price', 'description', 'created_by', 'action' ],
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
    this.paginatied.page = this.$route.query.page || 1;
    this.paginatied.per_page = this.$route.query.per_page || 30;
    this.paginatied.model_id = this.$route.query.model_id;
    this.paginatied.make_id = this.$route.query.make_id;
    console.log(this.paginatied);
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
      const data = await this.showAllListings(this.paginatied);

      this.total = data.pagination.total;
      this.paginatied.page = data.pagination.current_page;
    },
    getPage() {
      return this.$route.query.page || 1;
    },
    async replaceUrl(value, type) {
      if (type === 'page') {
        this.paginatied.page = value;
        this.$router
          .push({ query: { ...this.$route.query, page: this.page } })
          .catch(() => {});
      }

      if (type === 'per_page') {
        this.paginatied.perPage = value;
        this.$router
          .push({ query: { ...this.$route.query, per_page: this.perPage } })
          .catch(() => {});
      }

      await this.showAllListings(this.paginatied);
    },
  },

};
</script>

<style>
.per_page{
  width: 10%;
}
</style>
