<template>
  <div>
    <div>
    <b-input-group size="sm">
      <b-input-group-prepend is-text>
        <b-icon icon="search"></b-icon>
      </b-input-group-prepend>
      <b-form-input
        id="filter-input"
        v-model="filter"
        type="search"
        placeholder="Type to Search"
      ></b-form-input>
        <b-button
          class="btn btn-mdb-color btn-rounded btn-sm my-0 ml-sm-2 waves-effect waves-light"
          :disabled="!filter"
          @click="filter = '' ">Clear</b-button>
    </b-input-group>
  </div>
    <b-table
      hover
      bordered
      sort-icon-right
      responsive="sm"
      :per-page="perPage"
      :current-page="currentPage"
      small
      :filter="filter"
      :items="products"
      :fields="product_fields"
      :filter-included-fields="['model', 'make', 'year', 'name', 'part_number']"
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
        <router-link v-b-modal :to="{name: 'infoProduct', params: {id: data.item.id}}">
          <b-icon icon="eye" variant="success"></b-icon>
        </router-link>
      </template>
    </b-table>
    <b-pagination
      v-model="currentPage"
      :total-rows="rows"
      :per-page="perPage"
      aria-controls="my-table"
    ></b-pagination>
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
      perPage: 10,
      currentPage: 1,
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
    this.getProducts()
  },
  methods: {
    getProducts() {
      this.axios.get('/products')
        .then(response => {
          this.products = response.data.data;
        })
        .catch(err => console.log(err))
    }
  },
  computed: {
    rows() {
      return this.product_fields.length
    }
  }
}

</script>
