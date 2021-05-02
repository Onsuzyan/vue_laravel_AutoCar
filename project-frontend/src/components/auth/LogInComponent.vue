<template>
  <div>
    <b-container class="mt-5" fluid="sm">
      <b-row align-h="center">
        <b-col cols="4">
          <h3>Добро пожаловать</h3>
          <b-form @submit.stop.prevent="onSubmit">
            <b-form-group id="input-group-1" label="Элеткроная почта" label-for="input-1">
              <b-form-input
                id="input-1"
                name="input-1"
                v-model="form.email"
                type="text"
                v-validate="'required|email'"
                :state="validateState('input-1')"
                aria-describedby="input-1-live-feedback"
                data-vv-as="Email"
              ></b-form-input>
              <b-form-invalid-feedback id="input-1-live-feedback">{{ veeErrors.first('input-1') }}</b-form-invalid-feedback>
            </b-form-group>
            <b-form-group id="input-group-2" label="Пароль" label-for="input-2">
              <b-form-input
                id="input-2"
                name="input-2"
                v-model="form.password"
                type="password"
                v-validate="'required|min:6|alpha_dash'"
                :state="validateState('input-2')"
                aria-describedby="input-2-live-feedback"
                data-vv-as="Password"
              ></b-form-input>
              <b-form-invalid-feedback id="input-2-live-feedback">{{ veeErrors.first('input-2') }}</b-form-invalid-feedback>
            </b-form-group>
            <b-button type="submit">Войти</b-button>
          </b-form>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>

export default {
  title: 'Log In',
  data() {
    return {
      form: {
        email: 'test@gmail.com',
        password: '123456'
      },
      show: true
    }
  },
  methods: {
    validateState(ref) {
      if (this.veeFields[ref] && (this.veeFields[ref].dirty || this.veeFields[ref].validated)) {
        return !this.veeErrors.has(ref);
      }
      return null;
    },
    resetForm() {
      this.form = {
        email: null,
        password: null
      };
      this.$nextTick(() => {
        this.$validator.reset();
      });
    },
    onSubmit() {
      this.$validator.validateAll().then(result => {
        if (!result) {
          return;
        }
        this.$store.dispatch('login', this.form).then(res => {
          if(res.status === 200){
            this.$router.push({name: 'Shop'});
          }
        }).catch(err => {
          if (err.status === 401) {
            alert('Email not registered');
          }
        });
      });
    }
  },
}
</script>

<style scoped>

</style>
