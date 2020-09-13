<template>
  <div class="container fixed-top justify-content-center justify-form-middle">
    <div class="d-flex justify-content-center h-100">
      <div class="user_card forgot-password-box">
        <div class="d-flex justify-content-center">
          <h2>Forgot Password</h2>
        </div>

        <div class="d-flex justify-content-center">
          <form>
            <b-form-group class="mb-3">
              <label>Email</label>
              <b-form-input placeholder="Email"
                            class="input_user"/>
            </b-form-group>
            <b-button variant="danger"
                      class="mt-3">Reset password</b-button>
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
.forgot-password-box {
  height: 260px;
}
</style>
