<template>
  <div class="home">
    <FitterHome/>
    <ListingHome />
  </div>
</template>

<script>
import ListingHome from '../components/Listing.vue';
import FitterHome from '../components/Fitter.vue';

export default {
  name:       'Home',
  components: {
    ListingHome,
    FitterHome,
  },
};
</script>
