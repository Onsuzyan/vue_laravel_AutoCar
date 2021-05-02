<template>
  <div>
    <b-container class="mt-5">
      <b-row align-h="center">
        <b-col cols="4">
          <h4>Create a new account</h4>
          <b-form @submit.stop.prevent="tryLogin">
            <b-form-group id="input-group-1" label="Имя" label-for="input-1">
              <b-form-input
                id="input-1"
                name="input-1"
                v-model="form.name"
                type="text"
                v-validate="'required|alpha|min:4'"
                :state="validateState('input-1')"
                aria-describedby="input-1-live-feedback"
                data-vv-as="Name"
              ></b-form-input>
              <b-form-invalid-feedback id="input-1-live-feedback">{{
                  veeErrors.first('input-1')
                }}
              </b-form-invalid-feedback>
            </b-form-group>
            <b-form-group id="input-group-2" label="Адрес" label-for="input-2">
              <b-form-input
                id="input-2"
                name="input-2"
                v-model="form.address"
                type="text"
                v-validate="'required|min:3|alpha_dash'"
                :state="validateState('input-2')"
                aria-describedby="input-1-live-feedback"
                data-vv-as="Address"
              ></b-form-input>
              <b-form-invalid-feedback id="input-2-live-feedback">{{
                  veeErrors.first('input-2')
                }}
              </b-form-invalid-feedback>
            </b-form-group>
            <b-form-group id="input-group-3" label="Телефон" label-for="input-3">
              <b-form-input
                id="input-3"
                name="input-3"
                v-model="form.phone"
                type="text"
                v-validate="'required|digits:9'"
                :state="validateState('input-3')"
                aria-describedby="input-3-live-feedback"
                data-vv-as="Phone"
              ></b-form-input>
              <b-form-invalid-feedback id="input-3-live-feedback">{{
                  veeErrors.first('input-3')
                }}
              </b-form-invalid-feedback>
            </b-form-group>
            <b-form-group id="input-group-4" label="Эл.почта" label-for="input-4">
              <b-form-input
                id="input-4"
                name="input-4"
                v-model="form.email"
                type="text"
                v-validate="'required|email'"
                :state="validateState('input-4')"
                aria-describedby="input-4-live-feedback"
                data-vv-as="Email"
              ></b-form-input>
              <b-form-invalid-feedback id="input-4-live-feedback">{{
                  veeErrors.first('input-4')
                }}
              </b-form-invalid-feedback>
            </b-form-group>
            <b-form-group id="input-group-5" label="Пароль" label-for="input-5">
              <b-form-input
                id="input-5"
                name="input-5"
                v-model="form.password"
                type="password"
                v-validate="'required|min:6|max:30|alpha_dash'"
                :state="validateState('input-5')"
                aria-describedby="input-5-live-feedback"
                data-vv-as="password"
                ref="password"
              ></b-form-input>
              <b-form-invalid-feedback id="input-5-live-feedback">{{
                  veeErrors.first('input-5')
                }}
              </b-form-invalid-feedback>
            </b-form-group>
            <b-form-group id="input-group-6" label="Повторите пароль" label-for="input-6">
              <b-form-input
                id="input-6"
                name="input-6"
                v-model="form.password_confirmation"
                type="password"
                v-validate="'required|min:6|max:30|alpha_dash|confirmed:password'"
                :state="validateState('input-6')"
                aria-describedby="input-6-live-feedback"
                data-vv-as="password confirmation"
              ></b-form-input>
              <b-form-invalid-feedback id="input-6-live-feedback">{{
                  veeErrors.first('input-6')
                }}
              </b-form-invalid-feedback>
            </b-form-group>
            <b-form-group id="input-group-7" label="Image" label-for="input-7">
              <b-form-file
                type="file"
                id="input-7"
                name="input-7"
                data-vv-as="Image"
                v-model="form.avatar"
                :state="validateState('input-7')"
                aria-describedby="input-7-live-feedback"
                v-validate="'required|mimes:image/jpeg,image/png,image/jpg'"
              ></b-form-file>
              <b-form-invalid-feedback id="input-7-live-feedback">{{
                  veeErrors.first('input-7')
                }}
              </b-form-invalid-feedback>
            </b-form-group>
            <b-button type="submit">Sign up</b-button>
          </b-form>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>

export default {
  title: 'Sign Up',
  data() {
    return {
      form: {
        name: '',
        address: '',
        phone: '',
        email: '',
        password: '',
        password_confirmation: '',
        avatar: null
      },
      errors: {
        name: '',
        address: '',
        phone: '',
        email: '',
        password: '',
      },
      show: true,
    }
  },
  methods: {
    tryLogin() {
      this.$validator.validateAll().then(result => {
        if (!result) {
          return;
        }
        this.$store.dispatch('register', this.form).catch(err => {
          if (err.response.status === 401) {
            alert("There was an error while sending the request.")
          }

          if (err.response && err.response.status === 422) {
            Object.keys(err.response.data.errors).map(item => {
              this.errors[item] = err.response.data.errors[item][0]
            });
          }
        });

      });
    },
    validateState(ref) {
      if (this.veeFields[ref] && (this.veeFields[ref].dirty || this.veeFields[ref].validated)) {
        return !this.veeErrors.has(ref);
      }
      return null;
    },
  },
}
</script>

<style scoped>

</style>
