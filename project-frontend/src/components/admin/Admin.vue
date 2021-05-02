<template>
  <div>
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
    <b-table
      hover
      bordered
      sort-icon-right
      responsive="sm"
      :filter="filter"
      :items="users"
      :fields="users_fields"
      :filter-included-fields="['name','email']"
    >
      <template v-slot:cell(more)="data">
        <router-link v-b-modal :to="{name: 'UserInfo', params: {id: data.item.id}}">
          <b-icon icon="eye" variant="success"></b-icon>
        </router-link>
      </template>
      <template v-slot:cell(status)="data">
        <div v-if="data.item.status === 1">
          <span class="badge bg-success">Active</span>
        </div>
        <div v-else>
          <span class="badge bg-danger">Blocked</span>
        </div>
      </template>
      <template v-slot:cell(active)="data">
        <div v-if="data.item.status === 1">
        <toggle-button v-b-modal.modalPopover @change="activeUser(data.item.id)" :value="true"/>
        </div>
        <div v-else>
          <toggle-button @change="activeUser(data.item.id)" :value="false"/>
        </div>
      </template>
    </b-table>
    <div class="modal">
      <b-modal id="modalPopover"  size = "xl" ok-only>
      <b-img class="imgGif" src="https://pa1.narvii.com/7688/1a8569594e9bd76f3d72b0443953887fd49b8c2ar1-480-320_hq.gif"/>
      </b-modal>
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      users: [],
      filter: null,
      status: true,
      labels: true,
      showModal: true,
      show: false,
      selectedItem: {},
      users_fields: [
        {key: 'id', label: 'N', sortable: true},
        {key: 'name', sortable: false},
        {key: 'phone', sortable: false},
        {key: 'email', sortable: true},
        {key: 'status'},
        {key: 'more'},
        {key: 'active'}
      ]
    }
  },
  created() {
    this.getAllUsers()

  },
  methods: {
    getAllUsers() {

      this.axios.get('/users')
        .then(response => {
          this.users = response.data.data;
        })
        .catch(err => console.log(err))
    },
    activeUser(id) {
        this.axios.get(`change/status/${id}`).then(res => {
          if(res.status === 200){
            this.getAllUsers();
          }
        }).catch(err => console.log(err))
    }
  }
}
</script>

<style scoped>
.imgGif{
  width: 100%;
}



</style>
