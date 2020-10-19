<template>
  <nav id="nav">
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link> |
    <router-link to="/auth">Login</router-link> |
    <router-link to="/signup">Signup</router-link> |
    <router-link to="/admin/listings">Listing</router-link>
  </nav>
</template>

<script>
export default {
  name: 'Navigation',
};
</script>

<style scoped>

</style>
