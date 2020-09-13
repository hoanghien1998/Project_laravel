<template>
  <div class="hello">
    <h2 data-vel="subheader">{{ msg }}</h2>
    <b-alert show
             dismissible
             variant="default">
      <span class="alert-icon"><i class="ni ni-like-2"/></span>
      <span class="alert-text">
        <strong>Default!</strong> This is a default alert—check it out!
      </span>
    </b-alert>

    <b-alert show
             dismissible
             variant="primary">
      <span class="alert-icon"><i class="ni ni-like-2"/></span>
      <span class="alert-text">
        <strong>Primary!</strong> This is a primary alert—check it out!
      </span>
    </b-alert>

    <b-alert show
             dismissible
             variant="secondary">
      <span class="alert-icon"><i class="ni ni-like-2"/></span>
      <span class="alert-text">
        <strong>Secondary!</strong> This is a secondary alert—check it out!
      </span>
    </b-alert>

    <b-alert show
             dismissible
             variant="info">
      <span class="alert-icon"><i class="ni ni-like-2"/></span>
      <span class="alert-text">
        <strong>Info!</strong> This is a info alert—check it out!
      </span>
    </b-alert>

    <b-alert show
             dismissible
             variant="success">
      <span class="alert-icon"><i class="ni ni-like-2"/></span>
      <span class="alert-text">
        <strong>Success!</strong> This is a success alert—check it out!
      </span>
    </b-alert>

    <b-alert show
             dismissible
             variant="danger">
      <span class="alert-icon"><i class="ni ni-like-2"/></span>
      <span class="alert-text">
        <strong>Danger!</strong> This is a danger alert—check it out!
      </span>
    </b-alert>

    <b-alert show
             dismissible
             variant="warning">
      <span class="alert-icon"><i class="ni ni-like-2"/></span>
      <span class="alert-text">
        <strong>Warning!</strong> This is a warning alert—check it out!
      </span>
    </b-alert>
  </div>
</template>

<script>
export default {
  name:  'HelloWorld',
  props: {
    // eslint-disable-next-line vue/require-default-prop
    msg: String,
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
