import Vue from 'vue';
import Vuex from 'vuex';

import auth from './modules/auth'
import user from './modules/user'
import product from './modules/product'
import userProduct from './modules/userProduct'

Vue.use(Vuex);

export default new Vuex.Store ({
      state: {},
      mutations: {},
      getters: {},
      actions: {},
      modules: {
        auth: auth,
        user: user,
        product:product,
        userProduct: userProduct
      }
})
