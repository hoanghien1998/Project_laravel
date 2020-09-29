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
              <span>{{ errors.first_name[0] }}</span>
            </b-form-group>
            <b-form-group class="mb-3">
              <label>Last Name</label>
              <b-form-input v-model="datas.last_name"
                            placeholder="Last name"
                            class="input_user"/>
            </b-form-group>
            <b-form-group class="mb-3">
              <label>Email</label>
              <b-form-input v-model="datas.email"
                            placeholder="Email"
                            class="input_user"/>
            </b-form-group>
            <b-form-group class="mb-3">
              <label>Password</label>
              <b-form-input v-model="datas.password"
                            type="password"
                            placeholder="Password"
                            class="input_user"/>
            </b-form-group>
            <b-form-group label="Gender">
              <b-form-radio v-model="datas.gender"
                            value="Male">Male
              </b-form-radio>
              <b-form-radio v-model="datas.gender"
                            value="Female">Female
              </b-form-radio>
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

// class Errors {
//   constructor() {
//     this.errors = {};
//   }
//
//   get(field) {
//     if (this.errors[field]) {
//       return this.errors[field][0];
//     }
//   }
//
//   record(errors) {
//     this.errors = errors.errors;
//   }
// }

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
      errors: {
        first_name: [],
        last_name:  [],
        email:      [],
        password:   [],
        gender:     [],
      },
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
          let xx = [];
          const self = this;
          // xx.each(item => {

          xx = error.response.data.errors;
          console.log(xx);
          Object.values(xx).forEach(item => {
            self.errors[item.field] = item.messages;
          });
          // console.log(this.errors);

          // const xxx = xx[0].messages[0];
          // });
          // debugger;
        });
    },
  },
};
</script>

<style>
.signup-box {
  height: 600px;
  padding: 20px;
}
</style>
