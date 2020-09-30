<template>
  <div class="container fixed-top justify-content-center justify-form-middle">
    <div class="d-flex justify-content-center h-100">
      <div class="user_card signup-box">
        <div class="d-flex justify-content-center">
          <h2>Sign Up</h2>
        </div>

        <div class="d-flex justify-content-center">

          <form method="post"
                @submit.prevent="register">
            <b-form-group class="mb-3">
              <label>First Name</label>
              <b-form-input v-model="datas.first_name"
                            placeholder="First name"
                            class="input_user"/>
              <span v-if="isError"
                    class="text-danger"
                    v-text="errors.get('first_name')"/>
            </b-form-group>
            <b-form-group class="mb-3">
              <label>Last Name</label>
              <b-form-input v-model="datas.last_name"
                            placeholder="Last name"
                            class="input_user"/>
              <span v-if="isError"
                    class="text-danger"
                    v-text="errors.get('last_name')"/>
            </b-form-group>
            <b-form-group class="mb-3">
              <label>Email</label>
              <b-form-input v-model="datas.email"
                            placeholder="Email"
                            class="input_user"/>
              <span v-if="isError"
                    class="text-danger"
                    v-text="errors.get('email')"/>
            </b-form-group>
            <b-form-group class="mb-3">
              <label>Password</label>
              <b-form-input v-model="datas.password"
                            type="password"
                            placeholder="Password"
                            class="input_user"/>
              <span v-if="isError"
                    class="text-danger"
                    v-text="errors.get('password')"/>
            </b-form-group>
            <b-form-group label="Gender">
              <b-form-radio v-model="datas.gender"
                            value="Male">Male
              </b-form-radio>
              <b-form-radio v-model="datas.gender"
                            value="Female">Female
              </b-form-radio>
              <span v-if="isError"
                    class="text-danger"
                    v-text="errors.get('gender')"/>
            </b-form-group>
            <b-button variant="danger"
                      type="submit"
                      class="mt-3">Signup
            </b-button>
          </form>
        </div>

        <div class="mt-4">
          <div class="d-flex justify-content-center links">
            Already registered&nbsp;<router-link to="/auth">Sign in ?</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

class Errors {
  constructor() {
    this.errors = {};
  }

  get(field) {
    console.log(this.errors[field]);
    if (this.errors[field]) {
      return this.errors[field];
    }
  }

  record(errors) {
    for (let i = 0; i < errors.length; i++) {
      const field = Object.values(errors[i])[0];

      // eslint-disable-next-line prefer-destructuring
      this.errors[field] = Object.values(errors[i])[1][0];
    }
    console.log(this.errors);
  }
}

export default {
  data() {
    return {
      datas: {
        first_name: '',
        last_name:  '',
        email:      '',
        password:   '',
        gender:     '',
      },
      errors:  new Errors(),
      isError: false,
    };
  },
  methods: {
    register() {
      this.gender = this.datas.gender;
      axios.post('/api/register', this.datas)
        .then(res => {
          console.log(res.data);
        })
        .catch(error => {
          this.errors.record(error.response.data.errors);
          this.isError = true;
        });
    },
  },
};
</script>

<style>
.signup-box {
  height: 700px;
  padding: 50px;
}
</style>
