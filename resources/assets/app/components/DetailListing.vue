<template>
  <div>
    <div class="container">
      <h1>
        {{ listing.carMake.name }}
        {{ listing.carModel.name }}
        {{ listing.carTrim.name }}, <span>{{ listing.year }}</span>
      </h1>
      <div class="description">
        {{ listing.description }}
      </div>
      <div>Price: <span class="price">${{ listing.price }}</span></div>
    </div>

    <div class="container">
      <b-row>
        <b-col>
          <b-img-lazy :src="main_img"
                      width="800px"
                      rounded
                      alt="Image 1"/>
        </b-col>
        <b-col>
          <b-img v-for="image in listing.medias"
                 :key="image"
                 :src="image.full"
                 center
                 thumbnail
                 style="margin-bottom: 10px"
                 alt="Center image"/>
        </b-col>
      </b-row>

    </div>
  </div>

</template>

<script>
import { createNamespacedHelpers } from 'vuex';

const { mapActions } = createNamespacedHelpers('listings');

export default {
  data() {
    return {
      listing:  {},
      main_img: '',
    };
  },
  async created() {
    await this.initPage();
  },
  methods: {
    ...mapActions(['detailListing']),
    async initPage() {
      const data = await this.detailListing(1);

      this.listing = data;
      this.main_img = this.listing.medias[0].full;
    },
  },
};
</script>

<style>
.price {
  font-weight: bold;
  font-size: 30pt;
}
.container {
  font-size: 18pt;
  margin-top: 10px;
}
</style>
