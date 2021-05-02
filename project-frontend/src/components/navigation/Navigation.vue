<template>
  <div>
    <div>
    <b-navbar type="light" variant="info" class="d-flex flex-row-reverse" >
        <b-navbar variant="faded" type="light">
        </b-navbar>
      <b-navbar-nav>
        <b-nav-item class="p-2 " :to="{name: 'MainPage'}">Домашняя Страница</b-nav-item>
        <b-nav-item class="p-2" v-if="!token" :to="{name: 'Login'}">Войти</b-nav-item>
        <b-nav-item class="p-2" v-if="!token" :to="{name: 'SignUp'}">Регистрация</b-nav-item>
        <b-nav-item class="p-2" :to="{name: 'Shop'}">Магазин</b-nav-item>
        <div v-if="role === 'admin'">
          <b-nav-item-dropdown right class="p-2" v-if="token">
            <template #button-content class ="btn btn-outline-primary">
              Profile
            </template>
            <b-dropdown-item v-if="token " :to="{name: 'Admin'}">Admin</b-dropdown-item>
            <b-dropdown-item  @click="logOut()">Выйти</b-dropdown-item>
          </b-nav-item-dropdown>
        </div>
        <div v-if="role === 'user'">
          <b-nav-item-dropdown right class="p-2" v-if="token">
            <template #button-content>
              <b-icon icon="person-fill" aria-hidden="true"></b-icon>Profile
            </template>
                <b-dropdown-item :to="{name: 'User' }">Мой профиль</b-dropdown-item>
                <b-dropdown-item  @click="logOut()">Выйти</b-dropdown-item>
          </b-nav-item-dropdown>
        </div>
      </b-navbar-nav>
    </b-navbar>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      r: null,
    }
  },
  computed: {
    token() {
      return this.$store.getters.checkAccessToken;
    },
    role() {
     return this.$store.getters.getUserRole;
    },
  },
  methods: {
    logOut() {
      if (confirm('Are you sure you want to quit??')) {
        if(localStorage.getItem('access_token')){
          this.$store.dispatch('logOutUser').then(res => {
            localStorage.removeItem('access_token');
            this.$router.push({name: 'MainPage'});
          }).catch(err => console.log(err))
        }
      }
      return false;
    }
  },
}
</script>

<style scoped>

</style>
