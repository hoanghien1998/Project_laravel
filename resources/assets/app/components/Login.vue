<template>
  <div class="container fixed-top justify-content-center justify-form-middle">
    <div class="d-flex justify-content-center h-100">
      <div class="user_card">
        <div class="d-flex justify-content-center">
          <div class="brand_logo_container">
            <img src="https://cdn.freebiesupply.com/logos/large/2x/pinterest-circle-logo-png-transparent.png"
                 class="brand_logo"
                 alt="Logo">
          </div>
        </div>
        <div class="d-flex justify-content-center form_container">
          <form autocomplete="off"
                method="post"
                @submit.prevent="login">
            <b-form-group class="mb-3">
              <b-input-group>
                <b-input-group-prepend>
                  <span class="input-group-text">
                    <font-awesome-icon icon="user"/>
                  </span>
                </b-input-group-prepend>
                <b-form-input v-model="credentials.email"
                              placeholder="user@example.com"
                              class="input_user"/>
              </b-input-group>
              <strong>{{ errors.email[0] }}</strong>
            </b-form-group>
            <b-form-group class="mb-2">
              <b-input-group>
                <b-input-group-prepend>
                  <span class="input-group-text">
                    <font-awesome-icon icon="key"/>
                  </span>
                </b-input-group-prepend>
                <b-form-input v-model="credentials.password"
                              type="password"
                              placeholder="password"
                              class="input_user"/>
              </b-input-group>
              <strong>{{ errors.password[0] }}</strong>
            </b-form-group>
            <b-form-checkbox
              id="checkbox-1"
              name="checkbox-1"
              value="accepted"
              unchecked-value="not_accepted"
            >
              Remember me
            </b-form-checkbox>
            <b-button variant="danger"
                      class="mt-3"
                      type="submit">Login
            </b-button>
          </form>
        </div>

        <div class="mt-4">
          <div class="d-flex justify-content-center links">
            Don't have an account?
            <router-link to="/signup"
                         class="ml-2">Signup
            </router-link>
          </div>
          <div class="d-flex justify-content-center links">
            <router-link to="/forgot-password"
                         class="ml-2">Forgot your password?
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      credentials: {
        email:    '',
        password: '',
      },
      errors: {
        email:    [],
        password: [],
      },
      message: '',
    };
  },
  methods: {
    async login() {
      const data = await this.$store.dispatch('loginUser/loginUser', this.credentials);


      console.log(data.errors);

      let e = [];
      const self = this;

      e = data.errors;
      console.log(e);
      Object.values(e).forEach(item => {
        self.errors[item.field] = item.messages;
      });
    },
  },
};
</script>

<style>
strong {
  color: red;
}
</style>
