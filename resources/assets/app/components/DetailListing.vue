<template>
  <div>
    <div class="container">
      <h1>
        Audi A6 Allroad, <span>2016</span>
      </h1>
      <div class="description">
        Lorem Ipsum is simply dummy text of the printing and <br>
        typesetting industry. Lorem Ipsum has been the industry's
      </div>
      <div>Price: <span class="price">$10.500</span></div>
    </div>

    <div class="container">
      <b-row>
        <b-col>
          <b-img-lazy rounded
                      src="https://picsum.photos/800/600/?image=80"
                      alt="Image 1"/>
        </b-col>
        <b-col>
          <b-img center
                 thumbnail
                 style="margin-bottom: 10px"
                 src="https://picsum.photos/125/125/?image=58"
                 alt="Center image"/>
          <b-img center
                 style="margin-bottom: 10px"
                 src="https://picsum.photos/125/125/?image=58"
                 alt="Center image"/>
          <b-img center
                 style="margin-bottom: 10px"
                 src="https://picsum.photos/125/125/?image=58"
                 alt="Center image"/>
          <b-img center
                 style="margin-bottom: 10px"
                 src="https://picsum.photos/125/125/?image=58"
                 alt="Center image"/>
          <b-img center
                 style="margin-bottom: 10px"
                 src="https://picsum.photos/125/125/?image=58"
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
    };
  },
  async created() {
    await this.initPage();
  },
  methods: {
    ...mapActions(['detailListing']),
    async initPage() {
      const data = await this.detailListing(1);
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
}
</style>
