<template>
  <div class="container fixed-top justify-content-center justify-form-middle">
    <div class="d-flex justify-content-center h-100">
      <div class="user_card signup-box">
        <div class="d-flex justify-content-center">
          <h2>Sign Up</h2>
        </div>

        <div class="d-flex justify-content-center">
          <form>
            <b-form-group class="mb-3">
              <label>Full Name</label>
              <b-form-input placeholder="Full name"
                            class="input_user"/>
            </b-form-group>
            <b-form-group class="mb-3">
              <label>Email</label>
              <b-form-input placeholder="Email"
                            class="input_user"/>
            </b-form-group>
            <b-form-group class="mb-3">
              <label>Password</label>
              <b-form-input type="password"
                            placeholder="Password"
                            class="input_user"/>
            </b-form-group>
            <b-button variant="danger"
                      class="mt-3">Signup</b-button>
          </form>
        </div>

        <div class="mt-4">
          <div class="d-flex justify-content-center links">
            Already registered&nbsp;<router-link to="/auth">Sign in?</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
};
</script>

<style>
.signup-box {
  height: 430px;
}
</style>
