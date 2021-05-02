<template>
  <div v-if="product.images && product.images[0].image_link">
    <div>
      <b-card no-body class="overflow-hidden" align="center" style="max-width: 60%;">
        <b-row no-gutters>
          <b-col md="6">
            <b-carousel
              id="product-images-carousel"
              v-model="slide"
              controls
              indicators
              no-animation
              img-width="250"
              img-height="250"
              background="black"
            >
              <div v-for="image in productImages">
                <b-carousel-slide
                  :img-src='image.image_link'
                ></b-carousel-slide>
              </div>
            </b-carousel>
          </b-col>
          <b-col
            md="6"
            header-bg-variant="dark"
          >
            <b-card-body align="center">
              <b-card-title align="center"> Model: {{ product.model }}</b-card-title>
              <b-list-group flush>
                <b-list-group-item><b>Name :</b>{{ product.name }}</b-list-group-item>
                <b-list-group-item><b>Make: </b>{{ product.make }}</b-list-group-item>
                <b-list-group-item><b>Year: </b>{{ product.year }}</b-list-group-item>
                <b-list-group-item><b>User: </b>{{ user.name }}</b-list-group-item>
                <b-list-group-item><b>Phone: </b>{{ user.phone }}</b-list-group-item>
                <b-list-group-item><b>Address: </b>{{ user.address }}</b-list-group-item>
                <b-list-group-item>
                  <router-link v-b-modal :to="{name: 'User'}">
                  <b-icon icon="eye" variant="success"></b-icon>
                </router-link>
                </b-list-group-item>
              </b-list-group>
            </b-card-body>
          </b-col>
        </b-row>
      </b-card>
    </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      product: {},
      user: {},
      slide:0,
      productImages: []
    }
  },
  created() {
    this.getProduct()
  },
  methods: {
    getProduct() {
      let id = this.$route.params.id;
      this.$store.dispatch('getOneProduct', this.$route.params.id).then(res => {
        this.product = res.product;
        this.productImages = res.product.images;
        this.user = res.user[0];
      })
    }
  },

}
</script>

<style scoped>

</style>
