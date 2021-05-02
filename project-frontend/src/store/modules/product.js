import axios from 'axios'
import router from '../../router'

const prefix = '/products';

export default {
  state: {
    products: [],
    current_product: null,
  },

  mutations: {
    // storeProducts(state, data) {
    //   state.product = data
    // },
    // storeProduct(state, data) {
    //   state.current_product = data
    // }
  },

  getters: {
    products(state) {
      return state.products
    },
    product(state) {
      return state.current_product
    },
  },

  actions: {
    setProduct(ctx, [data1, data2]) {
      return new Promise((resolve, reject) => {
        let form_data = new FormData();
        form_data.append('name', data1.name);
        form_data.append('model', data1.model);
        form_data.append('make', data1.make);
        form_data.append('year', data1.year);
        form_data.append('part_number', data1.part_number);
        if (data2) {
          data2.map((val, index) => {
            form_data.append(`image[${index}]`, val);
          })
        }
        form_data.append('_method', 'post');

        axios.post(`${prefix}`, form_data, {headers: {'Content-Type': 'multipart/form-data'}})
          .then(res => {
            if (res.status === 200) {
              return router.push({name: 'Shop',});
            }
          }).catch(err => {
          reject(err)
        })
      })
    },


    CreateProduct(context, data) {
      axios.post(prefix, data)
        .then(res => {
          if (res.status === 200) {
            router.push('Shop')
          }
        }).catch(err => {
        console.log(err.response)
      })
    },
    getModel(context, id) {
      return new Promise((resolve, reject) => {
        axios.get(`get/model/${id}`).then(res => {
          if (res.status === 200) {
            resolve(res.data)
          }
        }).catch(err => {
          reject(error)
        })
      })
    },
    getMake(context) {
      return new Promise((resolve, reject) => {
        axios.get('get/make').then(res => {
          if (res.status === 200) {
            resolve(res.data);
          }
        }).catch(err => {
          console.log(err);
        })
      })
    },
    getYear(context, name) {
      return new Promise((resolve, reject) => {
        axios.get(`get/year/${name}`).then(res => {
          if (res.status === 200) {
            resolve(res.data)
          }
        }).catch(err => {
          reject(err);
        })
      })
    },
    getOneProduct(context, id) {
      return new Promise((resolve, reject) => {
        axios.get(`${prefix}/${id}`).then(res => {
          if (res.status === 200) {
            resolve(res.data)
          }
        }).catch(err => {
          reject(err);
        })
      })
    },
    updateProduct(ctx, [data1, data2, id]) {
      return new Promise((resolve, reject) => {
        let updateProduct = new FormData();
        updateProduct.append('id', data1.id);
        updateProduct.append('name', data1.name);
        updateProduct.append('model', data1.model);
        updateProduct.append('make', data1.make);
        updateProduct.append('year', data1.year);
        updateProduct.append('part_number', data1.part_number);
        updateProduct.append('user_id', data1.user_id);
        if (data2) {
          data2.map((val, index) => {
            updateProduct.append(`image[${index}]`, val);
          })
        }
        updateProduct.append('_method', 'put');


        axios.post(`${prefix}/${id}`, updateProduct, {headers: {'Content-Type': 'multipart/form-data'}})
          .then(res => {
            if (res.status === 200) {
              return router.push({name: 'User',});
            }
          }).catch(err => {
          reject(err)
        })
      })
    },

  },

}
