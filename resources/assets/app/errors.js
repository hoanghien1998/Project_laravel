export default class Errors {
  constructor() {
    this.errors = {};
  }

  // eslint-disable-next-line consistent-return
  get(field) {
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
  }
}
