<template>
  <div>
    <header>
      <navigation />
    </header>
    <router-view/>
  </div>
</template>

<script>
import Navigation from '../components/Navigation.vue';

export default {
  name:       'DefaultLayout',
  components: { Navigation },
};
</script>
