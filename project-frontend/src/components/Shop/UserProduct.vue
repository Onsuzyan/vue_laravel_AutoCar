<template>
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
      <template v-slot:cell(more)="data">
        <router-link :to="{name: 'infoProduct', params: {id: data.item.id}}">
          <b-icon icon="eye" variant="success"></b-icon>
        </router-link>
        <router-link :to="{name: 'EditProduct', params: {id: data.item.id}}">
          <b-icon icon="pen" variant="warning"></b-icon>
        </router-link>
        <b-icon icon="trash" variant="danger" @click="deleteProduct(data.item)"></b-icon>
      </template>
    </b-table>
    <b-input-group size="sm">
      <b-form-input
        id="filter-input"
        v-model="filter"
        type="search"
        placeholder="Type to Search"
      ></b-form-input>

      <b-input-group-append>
        <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
      </b-input-group-append>
    </b-input-group>
  </div>
</template>

<script>

export default {
  data() {
    return {
      products: [],
      filter: null,
      show: false,
      selectedItem: {},
      params: {
        search: '',
      },
      product_fields: [
        {key: 'id', label: 'N', sortable: true},
        {key: 'image', sortable: false},
        {key: 'name', sortable: false},
        {key: 'model', sortable: true},
        {key: 'make', label: 'Make', sortable: true},
        {key: 'year', label: 'Year', sortable: true},
        {key: 'part_number', label: 'Part N', sortable: false},
        {key: 'more'}
      ]
    }


  },
  created() {
    this.getUserProducts()
  },
  methods: {
    getUserProducts() {
        this.$store.dispatch('getUserProduct').then(res => {
          this.products = res.data
          }
        ).catch(err => console.log(err))
    },
    deleteProduct(product){
      if(confirm(`Are you sure to delete product ${product.name}`)){
        this.$store.dispatch('deleteProduct' , product.id).then( res => {
            return this.getUserProducts()
          }).catch(err => console.log(err))
      } return;
    }
  },

}

</script>
