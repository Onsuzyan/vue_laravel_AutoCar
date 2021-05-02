import axios from 'axios'
import router from '../../router'

const prefix = 'auth';

export default {
  state: {
    access_token: localStorage.getItem('access_token'),
    currentUser: null,
    userRole: null,
  },
  mutations: {
    storeToken(state, data) {
      state.access_token = data;
      localStorage.setItem('access_token', data);
    },
    storeCurrentUserData(state, data) {
      state.currentUser = data;
    },
    setRole(state, data) {
      state.userRole = data;

    },
    destroyTokenAndUser(state) {
      state.access_token = null;
      state.currentUser = null;
      localStorage.removeItem('access_token')
    }
  },
  getters: {
    checkAccessToken(state) {

      return state.access_token
    },
    getUserRole(state) {
      return state.userRole;
    },
    getCurrentUser(state) {
      return state.currentUser;
    }
  },
  actions: {
    login(ctx, form) {
      return new Promise((resolve, reject) => {
        axios.post(`${prefix}/login`, form).then(res => {
          if (res.status === 200) {
            ctx.commit('storeToken', res.data.access_token);
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + res.data.access_token;
            ctx.dispatch('getUserData');
            resolve(res);
          }
        }).catch(error => {
          reject(error)
        });
      })
    },
    getUserData(context) {
      return new Promise((resolve, reject) => {
        axios.post(`${prefix}/user`).then(res => {
          if (res.status === 200) {
            context.commit('storeCurrentUserData', res.data);
            context.commit('setRole', res.data.role);
            resolve(res);
          }
        }).catch(error => {
          reject(error);
        })
      });
    },
    register(ctx, data) {
      const config = {headers: {'Content-Type': 'multipart/form-data'}};
      let newUserFormData = new FormData();
      newUserFormData.append('avatar', data.avatar);
      newUserFormData.append('name', data.name);
      newUserFormData.append('phone', data.phone);
      newUserFormData.append('address', data.address);
      newUserFormData.append('email', data.email);
      newUserFormData.append('password', data.password);
      newUserFormData.append('password_confirmation', data.password_confirmation);


      return new Promise((resolve, reject) => {
        axios.post(`/${prefix}/register`, newUserFormData, config).then(res => {
          if (res.status === 200) {
            return router.push({name: 'Shop'});
          }
        }).catch(error => {
          reject(error);
        });
      })
    },
    verification(ctx, data) {
      return new Promise((resolve, reject) => {
        axios.post(`${prefix}/verify`, data).then(res => {
          if (res.status === 200) {
            return router.push({name:'Shop',});
          }
        })
          .catch(error => {
            reject(error);
          });
      })
    },
    logOutUser(context, request = true) {
      return new Promise((resolve, reject) => {
        if (!request) {
          context.commit('destroyTokenAndUser');
          return router.push({name: 'Login'})
        } else {
          axios.post(`${prefix}/logout`).then(res => {
            if (res.status === 200) {
              context.commit('destroyTokenAndUser');
              resolve(res.data);
            }
          }).catch(error => {
            reject(error);
          })
        }
      })
    },
  }
}
