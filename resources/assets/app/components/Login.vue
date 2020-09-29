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
        <div v-if="loading">
          <div class="spinner-border"
               role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
        <div v-else
             class="d-flex justify-content-center form_container">
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
import axios from 'axios';

export default {
  data() {
    return {
      credentials: {
        email:    '',
        password: '',
      },
      loading: true,
    };
  },
  mounted() {
    if (this.$store.state.token !== '') {
      axios.post('/api/checkToken', { token: this.$store.state.token })
        .then(res => {
          if (res) {
            this.loading = false;
            this.$router.push('/');
          }
        })
        .catch(err => {
          console.log(err);
          this.loading = false;
          this.$store.commit('clearToken');
        });
    } else {
      this.loading = false;
    }
  },
  methods: {
    login() {
      axios.post('/api/auth', this.credentials)
        // eslint-disable-next-line no-unused-vars
        .then(res => {
          this.$store.commit('setToken', res.data.token);
          this.$router.push('/');
        })
        .catch(err => {
          console.log(err);
        });
    },
  },
};
</script>

<style>

</style>
