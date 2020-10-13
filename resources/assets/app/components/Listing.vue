<template>
  <div class="container">
    <b-table id="my-table"
             ref="table"
             :items="items"
             hover
             bordered/>
    <b-pagination v-if="total > 0"
                  v-model="page"
                  :total-rows="total"
                  :per-page="perPage"
                  prev-text="Prev"
                  next-text="Next"
                  @change="handlePageChange"

    />

    <!--    <b-form-select v-model="selected"-->
    <!--                   :options="options"-->
    <!--                   class="per-page"/>-->

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
      page:     1,
      perPage:  30,
      selected: 30,
      options:  [
        { value: 30, text: 30 },
        { value: 'a', text: 'This is First option' },
        { value: 'b', text: 'Selected Option' },
        { value: { C: '3PO' }, text: 'This is an option with object value' },
        { value: 'd', text: 'This one is disabled', disabled: true },
      ],
      pagination: null,
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
    await this.initPage();
  },
  methods: {
    ...mapActions(['showAllListings']),
    async handlePageChange(value) {
      await this.replaceUrl(value);
      await this.showAllListings({
        page:     this.page,
        per_page: this.perPage,
      });
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
    replaceUrl(value) {
      this.page = value;
      this.$router
        .push({ query: { ...this.$route.query, page: this.page } })
        .catch(() => {});
    },
  },

};
</script>

<style>
.per-page {
  width: 1%;
}
</style>
