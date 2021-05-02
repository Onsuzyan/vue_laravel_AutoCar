import axios from 'axios'
import router from '../../router'
const prefix ='user/product';

export default {
  state: {},
  mutations: {},
  getters: {},
  actions: {
    getUserProduct(context,data){
      return new Promise((resolve, reject) => {
        axios.get(`${prefix}`).then(res => {
          resolve(res.data)
        })
      })
    },
    deleteProduct(context,id) {
      return new Promise((resolve, reject) => {
        axios.delete(`${prefix}/${id}`).then(res => {
          if(res.status === 200){
            resolve(res)
          }
        }).catch(err => {
          console.log(err)
        })
      })
    },
    getOneUserInfo(ctx, id) {
      return new Promise((resolve, reject) => {
        axios.get(`/user/${id}`).then(res => {
          if (res.status === 200) {
            resolve(res.data);
          }
        }).catch(error => {
          reject(error)
        });
      });
    },
    getOneUserProducts(ctx, id) {
      return new Promise((resolve, reject) => {
        axios.get(`/user/${id}/products`).then(res => {
          if (res.status === 200) {
            resolve(res.data);
          }
        }).catch(err => {
          reject(err);
        })
      })
    },
  },
}

