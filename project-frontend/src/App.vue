<template>
  <div id="app">
    <div id="nav">
      <main-nav></main-nav>
    </div>
    <div>
      <router-view :key="$route.fullPath"/>
    </div>


  </div>
</template>

<script>

export default {
  name: 'App',
  mounted() {
    if (this.$route.meta && this.$route.meta.auth) {
      this.$store.dispatch('getUserData')
    }
  },
}
</script>

<style>

</style>
