import Vue from 'vue'
import auth from './auth'
import shop from './shop'
import user from './user'
import store from '../store'
import Router from 'vue-router';
import MainPage from "../components/MainPage";
import NotFound from '../components/NotFound';
import test from "../components/test";

Vue.use(Router)

let mainRouter = new Router({
  mode: 'history',
  routes: [
    {path: '/', name: 'MainPage', component: MainPage},
    {path: '*', name: 'NotFound', component: NotFound},
    {path: '/test', name: 'test', component: test},

    ...auth,
    ...shop,
    ...user,
  ]
});

mainRouter.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some(record => record.meta.userAuth);
  const requiresAdmin = to.matched.some(record => record.meta.roleAdmin);
  const requiresUser = to.matched.some(record => record.meta.roleUser);
  const token = localStorage.getItem('access_token');

  if (requiresAuth && !token) {
    next('/login');
  } else if (to.path === '/login' && token) {
    next('/shop');
  } else if (to.path === '/signup' && token) {
    next('/shop');
  } else if (requiresAdmin && token) {
    store.dispatch('getUserData').then(res => {
      if (res) {
        if (res.data.role !== 'admin') {
          next('/shop');
        }
      }
      next();
    }).catch(error => {})
  } else if (requiresUser && token) {
    store.dispatch('getUserData').then(res => {
      if (res) {
        if (res.data.role !== 'user') {
          next('/shop');
        }
      }
      next();
    }).catch(error => {})
  } else {
    next();
  }
});

export default mainRouter;
