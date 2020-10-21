<template>
  <div class="home">
    <ListingHome />
  </div>
</template>

<script>
import ListingHome from '../components/Listing.vue';

export default {
  name:       'Home',
  components: {
    ListingHome,
  },
};
</script>
