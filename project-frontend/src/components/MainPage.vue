<template>
  <div>
    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="jumbotron-heading"> Добро пожаловать в наш интернет- магазин автозапчастей!</h1>
        <p class="lead text-muted">
          У нас вы найдёте все необходимые запчасти для своего автомобиля!
          Большой выбор продукции!
          Удобный подбор по параметрам авто!
          Доступные цены!
        <p>
         <router-link class="btn btn-primary":to="{name: 'Shop'}">Перейти в магазин</router-link>
        </p>
      </div>
    </section>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>


</style>
