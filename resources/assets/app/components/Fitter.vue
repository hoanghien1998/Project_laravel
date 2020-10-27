<template>
  <div class="container">
    <form>
      <div class="row"
           style=" margin-bottom: 10px; margin-top: 15px">
        <div class="col-md-4">
          <select v-model="car_make">
            <option v-for="carMake in carMakes"
                    :key="carMake.id"
                    :value="carMake.id">{{ carMake.name }}</option>
          </select>
        </div>
        <div class="col-md-4">
          <select v-model="car_model">
            <option v-for="carModel in carModels"
                    :key="carModel.id"
                    :value="carModel.id">{{ carModel.name }}</option>
          </select>
        </div>
        <div class="col-md-4">
          <select v-model="car_trim">
            <option v-for="carTrim in carTrims"
                    :key="carTrim.id"
                    :value="carTrim.id">{{ carTrim.name }}</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-2">
          <p>Produced between</p>
        </div>
        <div class="col-md-3">
          <b-form-input
            id="input-1"
            v-model="year_start"
            type="text"
            placeholder="Enter year start"
          />
        </div>
        <div class="col-md-1">
          <p>and</p>
        </div>

        <div class="col-md-3">
          <b-form-input
            id="input-2"
            v-model="year_now"
            type="text"
            placeholder="Enter year now"
          />
        </div>
        <div class="col-md-1">
          <p>year</p>
        </div>
        <div class="col-md-2">
          <b-button type="submit"
                    variant="danger">Find</b-button>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  name: 'Fitter',
  data() {
    return {
      carMakes:   [],
      car_make:   '',
      carModels:  [],
      car_model:  '',
      carTrims:   [],
      car_trim:   '',
      year_start: '',
      year_now:   '',
    };
  },
  beforeMount() {
    this.getCarMakes();
    this.getCarModels();
    this.getCarTrims();
  },
  methods: {
    getCarMakes() {
      axios.get('/api/cars/makes').then(response => {
        this.carMakes = response.data.results;
      });
    },

    getCarModels() {
      axios.get('/api/cars/models').then(response => {
        this.carModels = response.data.results;
      });
    },

    getCarTrims() {
      axios.get('/api/cars/trims').then(response => {
        this.carTrims = response.data.results;
      });
    },
  },
};
</script>

<style>

</style>
