// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'
import mixins from './mixins'
import VeeValidate from "vee-validate";
import vSelect from "vue-select";
import ToggleButton from 'vue-js-toggle-button';

Vue.use(ToggleButton)


Vue.component("v-select", vSelect);

Vue.use(VeeValidate, {
  inject: true,
  fieldsBagName: 'veeFields',
  errorBagName: 'veeErrors'
})

import './scss/_main.scss';
require('./plugins');

Vue.config.productionTip = false
Vue.mixin(mixins);

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
