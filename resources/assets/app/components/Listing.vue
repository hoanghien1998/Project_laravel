<template>
  <div class="container">
    <div v-for="item in items"
         :key="item.id"
         class="row">
      <div class="col-md-3">
        <img :src="item.thumbnail[0]"
             class="image" >
      </div>
      <div class="col-md-3">
        <h3 class="mt-0">{{ item.name[0] }}, {{ item.year }}</h3>
        <h4> ${{ item.price }}</h4>
      </div>
    </div>
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
      fields: [ 'id', 'car_model_id', 'car_trim_id', 'year', 'price', 'description', 'created_by' ],
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

<style lang="scss" scoped>
.image {
  width: 250px;
  height: 250px;
  border: 1px solid #ddd;
}
ul {
  list-style: none;
}
.row {
  margin-top: 5px;
}
.home {
  margin: 0 auto;
}
</style>
