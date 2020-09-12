<template>
  <div class="home">
    <b>{{ count }}</b>
    <img alt="Vue logo"
         src="../assets/logo.png">
    <HelloWorld msg="Welcome to Your Vue.js App"/>
  </div>
</template>

<script>
import HelloWorld from '../components/HelloWorld.vue';

export default {
  name:       'Home',
  components: {
    HelloWorld,
  },
  data() {
    return {
      count: 0,
    };
  },
  mounted() {
    setInterval(() => {
      ++this.count;
    }, 1000);
  },
};
</script>
