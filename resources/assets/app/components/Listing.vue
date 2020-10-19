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
      <template v-slot:cell(action)="data">
        <b-button v-if="data.item.approve"
                  size="sm"
                  class="mr-2"
                  variant="success"
                  @click="approveListing(data.item)">
          approved
        </b-button>
        <b-button v-if="!data.item.approve"
                  size="sm"
                  class="mr-2"
                  variant="danger"
                  @click="approveListing(data.item)">
          unapproved
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
      editedIndex: -1,
      total:       0,
      paginatied:  {
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
    await this.initPage();
  },
  methods: {
    ...mapActions([ 'showAllListings', 'updateApproveListing' ]),
    async handlePageChange(value) {
      await this.replaceUrl(value, 'page');
      await this.showAllListings(this.paginatied);
      await this.$refs.table.refresh();
    },
    async handlePerpageChange(value) {
      await this.replaceUrl(value, 'per_page');
      await this.showAllListings(this.paginatied);
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
          .push({ query: { ...this.$route.query, page: this.paginatied.page } })
          .catch(() => {});
      }

      if (type === 'per_page') {
        this.paginatied.perPage = value;
        this.$router
          .push({ query: { ...this.$route.query, per_page: this.paginatied.per_page } })
          .catch(() => {});
      }
    },

    async approveListing(item) {
      this.editedIndex = this.items.indexOf(item);

      // eslint-disable-next-line prefer-destructuring
      const id = this.items[this.editedIndex].id;

      await this.updateApproveListing(id);
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
