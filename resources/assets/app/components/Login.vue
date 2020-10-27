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
          <form>
            <b-form-group class="mb-3">
              <b-input-group>
                <b-input-group-prepend>
                  <span class="input-group-text">
                    <font-awesome-icon icon="user" />
                  </span>
                </b-input-group-prepend>
                <b-form-input placeholder="username"
                              class="input_user"/>
              </b-input-group>
            </b-form-group>
            <b-form-group class="mb-2">
              <b-input-group>
                <b-input-group-prepend>
                  <span class="input-group-text">
                    <font-awesome-icon icon="key" />
                  </span>
                </b-input-group-prepend>
                <b-form-input type="password"
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
                      class="mt-3">Login</b-button>
          </form>
        </div>

        <div class="mt-4">
          <div class="d-flex justify-content-center links">
            Don't have an account?
            <router-link to="/signup"
                         class="ml-2">Signup</router-link>
          </div>
          <div class="d-flex justify-content-center links">
            <router-link to="/forgot-password"
                         class="ml-2">Forgot your password?</router-link>
          </div>
        </div>
      </div>
    </div>

    <b-form-file
      v-model="file"
      :state="Boolean(file)"
      placeholder="choose file..."
      drop-placeholder="drop file..."
      @change="chooseFile"
    />
    <p>{{ file ? file.name : '' }}</p>
  </div>
</template>

<script>
import uploadService from '../services/uploadService';


export default {
  data() {
    return {
      file: null,
    };
  },
  methods: {
    chooseFile(e) {
      const filename = e.target.files[0].name;

      const file = e.target.files[0];


      const uploadRequest = uploadService.uploadTmp(filename, file);

      console.log(uploadRequest);
    },
  },
};
</script>

<style>

</style>
