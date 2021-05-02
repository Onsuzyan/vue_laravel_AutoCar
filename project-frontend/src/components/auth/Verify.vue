<template>
  <div>
    <b-container>
      <b-col>
        <h4>Password</h4>
        <b-form @submit.prevent="verification">
          <b-form-group label="Email">
            <b-input
              id="email"
              type="email"
              disabled
              v-model="form.email"
              :placeholder="form.email"
            ></b-input>
          </b-form-group>
          <b-form-group label="password">
            <b-input
              id="password"
              type="password"
              v-model="form.password"
              patterm="^[0-9a-zA-Z]+$"
              placeholder="You Password"
            ></b-input>
          </b-form-group>
          <b-button
            type="submit"
            class="mt-2"
            variant="success"
          >send
          </b-button>

        </b-form>
      </b-col>
    </b-container>
  </div>
</template>

<script>
export default {
  title: 'email',
  data() {
    return {
      form: {
        email: '',
        password: '',
        token: ''
      }
    }
  },
  //загрузка после компонениа и до даты
  mounted() {
    this.form.email = this.$route.params.email
    this.form.token = this.$route.params.token
  },

  methods: {
    verification() {
      if (this.form.email === this.$route.params.email) {
        if (this.form.password == null || this.form.password == '' || this.form.password.length < 6) {
          alert('Пароль неверный');
          return;
        }
        this.$store.dispatch('verification', this.form);
      }
      else {
        alert('емаил неверный')
        return;
      }
    }
  }
}
</script>

<style scoped>

</style>
