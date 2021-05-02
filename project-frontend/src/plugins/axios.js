import Vue from 'vue';
import axios from 'axios';
import VueAxios from "vue-axios";
import store from '../store'

axios.defaults.baseURL = process.env.API_URL;
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token');

axios.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    if (error.response.status === 401) {
      store.dispatch('logOutUser', false).catch(err => {})
    }

    return Promise.reject(error.response)
  });

Vue.use(VueAxios, axios);
