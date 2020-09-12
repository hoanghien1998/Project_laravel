<template>
  <div class="vue-template fixed-top d-flex align-items-center justify-content-center form-middle">
    <form>
      <h3>Sign In</h3>

      <div class="form-group">
        <label>Email address</label>
        <input type="email"
               class="form-control form-control-lg" >
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password"
               class="form-control form-control-lg" >
      </div>

      <button type="submit"
              class="btn btn-dark btn-lg btn-block">Sign In</button>

      <p class="forgot-password text-right mt-2 mb-4">
        <router-link to="/forgot-password">Forgot password ?</router-link>
      </p>

      <div class="social-icons">
        <ul>
          <li><a href="#"><i class="fa fa-google"/></a></li>
          <li><a href="#"><i class="fa fa-facebook"/></a></li>
          <li><a href="#"><i class="fa fa-twitter"/></a></li>
        </ul>
      </div>

    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
};
</script>
