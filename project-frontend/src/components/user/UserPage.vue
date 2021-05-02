<template>
  <div>
    <b-container class="mt-2">
      <b-row>
        <b-col cols="3">
          <div class="card-body text-center">
            <b-card class="image_inner_container" title=""
                    :img-src="(user.avatar && user.avatar.avatar_link) || 'https://pbs.twimg.com/media/EFIv5HzUcAAdjhl.png' "
                    img-alt="Avatar"
                    img-top
                    tag="article"
                    style="max-width: 15rem;"
            >
              <b-card-text>
                <div class="mt-3">
                  <h4>{{ user.name }}</h4>
                  <span>
                     <b-icon icon="person-fill"></b-icon>
                    <b>{{ user.role }}</b>
                  </span>
                  <p class="text-secondary mb-1">
                    <b-icon icon="at"></b-icon>
                    {{ user.email }}
                  </p>
                  <p class="text-muted font-size-sm">
                    <b-icon icon="telephone"></b-icon>
                    {{ user.phone }}
                  </p>
                  <b-button v-b-modal.user-info>
                    <b-icon icon="gear"></b-icon>
                    Settings
                  </b-button>
                </div>
              </b-card-text>
            </b-card>
            <div>
              <b-modal id="user-info" ref="user-info" title="User Information" hide-footer>
                <b-form id="modal-form">
                  <b-form-group label="Picture:" label-for="avatar" label-cols-sm="2">
                    <b-form-file
                      plain
                      id="input-1"
                      class="mt-3"
                      name="input-1"
                      data-vv-as="input-1"
                      aria-describedby="avatar"
                      v-model="modalForm.avatar"
                      :state="validateState('avatar')"
                      v-validate="'mimes:image/jpeg,image/png,image/jpg'"
                    ></b-form-file>
                    <b-form-invalid-feedback id="input-1-live-feedback">{{
                        veeErrors.first('input-1')
                      }}
                    </b-form-invalid-feedback>
                  </b-form-group>
                  <b-form-group
                    id="input-group-2"
                    label="Your Name:"
                    label-for="input-2">
                    <b-form-input
                      id="input-2"
                      type="text"
                      name="input-2"
                      data-vv-as="name"
                      v-model="modalForm.name"
                      :placeholder="user.name"
                      :state="validateState('input-2')"
                      v-validate="'required|alpha_dash|min:3|max:15'"
                    ></b-form-input>
                    <b-form-invalid-feedback id="input-2-live-feedback">{{
                        veeErrors.first('input-2')
                      }}
                    </b-form-invalid-feedback>
                  </b-form-group>
                  <b-form-group
                    id="input-group-3"
                    label="Your Phone:"
                    label-for="input-3">
                    <b-form-input
                      id="input-3"
                      type="text"
                      name="input-3"
                      v-model="modalForm.phone"
                      data-vv-as="phone"
                      pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}"
                      :placeholder="user.phone"
                      v-validate="'required|digits:9'"
                      :state="validateState('input-3')"
                    ></b-form-input>
                    <b-form-invalid-feedback id="input-3-live-feedback">{{
                        veeErrors.first('input-3')
                      }}
                    </b-form-invalid-feedback>
                  </b-form-group>
                  <b-form-group
                    id="input-group-5"
                    label="Your Address:"
                    label-for="input-5">
                    <b-form-input
                      id="input-5"
                      name="input-5"
                      type="text"
                      data-vv-as="address"
                      v-model="modalForm.address"
                      :placeholder="user.address"
                      v-validate="'required|alpha_dash'"
                      :state="validateState('input-5')"
                    ></b-form-input>
                    <b-form-invalid-feedback id="input-5-live-feedback">{{
                        veeErrors.first('input-5')
                      }}
                    </b-form-invalid-feedback>
                  </b-form-group>
                  <b-button type="button" @click="sendForm">Save Changes</b-button>
                </b-form>
              </b-modal>
            </div>
          </div>

        </b-col>
        <b-col cols="9">
          <div>
            <router-link :to="{name: 'GetProduct'}" class="btn btn-success my-2">
              Create product
            </router-link>
            <UpdateProduct/>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </div>

</template>

<script>


export default {
  data() {
    return {
      user: {},
      modalForm: {}
    }
  },
  methods: {
    sendForm() {
      this.$validator.validateAll().then(result => {
        console.log(result)
        if (!result) {
          return;
        }
        this.$store.dispatch('updateUserInformation', this.modalForm).then(res => {
          if (res.status == 200) {
            this.$refs['user-info'].hide();
          }
        })
      });
    },
    validateState(ref) {
      if (this.veeFields[ref] && (this.veeFields[ref].dirty || this.veeFields[ref].validated)) {
        return !this.veeErrors.has(ref);
      }
      return null;
    }
  },
  created() {
    this.$store.dispatch('getUserData').then(res => {
      this.user = res.data;
      this.modalForm = {
        avatar: [],
        name: this.user.name,
        phone: this.user.phone,
        address: this.user.address
      }
    }).catch('dfsd')
  },
  computed: {
    token() {
      return this.$store.getters.checkAccessToken
    },
  },
}

</script>

<style scoped>

</style>
