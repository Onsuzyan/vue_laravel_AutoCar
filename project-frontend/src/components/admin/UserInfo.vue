<template>
  <div>
    <b-container class="mt-2">
      <b-row>
        <b-col cols="3">
          <div class="card-body text-center">
            <b-card title=""
                    :img-src="(user.avatar && user.avatar.avatar_link) || 'https://pbs.twimg.com/media/EFIv5HzUcAAdjhl.png' "
                    img-alt="Avatar"
                    img-top
                    tag="article"
                    style="max-width: 15rem;"
                    class="rounded">
              <b-card-text>
                <div class="mt-3">
                  <h4>{{ user.name}}</h4>
                  <span>
                     <b-icon icon="person-fill"></b-icon>
                    <b>{{ user.role }}</b></span>
                  <p class="text-secondary mb-1">
                    <b-icon icon="at"></b-icon>
                    {{ user.email }}
                  </p>
                  <p class="text-muted font-size-sm">
                    <b-icon icon="telephone"></b-icon>
                    {{ user.phone }}
                  </p>
                </div>
              </b-card-text>
            </b-card>
          </div>
        </b-col>
        <b-col>
          <div>
            <b-table
              hover
              bordered
              sort-icon-right
              responsive="sm"
              :filter="filter"
              :filter-included-fields="['name', 'part_number']"
              :items="products"
              :fields="product_fields"
            >

              <template v-slot:cell(image)="data">
                <div v-if="data.item.images.length && data.item.images[0].image_link">
                  <b-img :src='data.item.images[0].image_link' fluid width="150" height="150"
                         alt="Product image"></b-img>
                </div>
                <div v-else>
                  <b-img
                    :src="'https://cdn.iconscout.com/icon/premium/png-256-thumb/empty-1670040-1418099.png'"
                    fluid width="150" height="150"
                    alt="Product image"></b-img>
                </div>
              </template>
            </b-table>
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
      user:{},
      products:[],
      filter: null,
      show: false,
      product_fields: [
        {key: 'id', label: 'N', sortable: true},
        {key: 'image', sortable: false},
        {key: 'name', sortable: false},
        {key: 'model', sortable: true},
        {key: 'make', label: 'Make', sortable: true},
        {key: 'year', label: 'Year', sortable: true},
        {key: 'part_number', label: 'Part N', sortable: false},
      ]
    }
  },
  methods: {
    getOneUserInfo(){
      this.$store.dispatch('getOneUserInfo', this.$route.params.id).then(res => {
      this.user = res.data[0]
      }).catch(err => console.log(err))
    },
    getOneUserProducts(){
      let id =  this.$route.params.id
      this.$store.dispatch('getOneUserProducts', this.$route.params.id).then(res =>{
        this.products = res.data
      }).catch(err => console.log(err))
    },
  },

  created() {
    this.getOneUserInfo()
    this.getOneUserProducts()
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
