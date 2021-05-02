import axios from 'axios'
import router from '../../router'
const prefix ='auth';

export default {
  state: {
    modalForm: {
      name: '',
      phone: '',
      avatar: null,
      address: '',
      email: '',
    }
  },
  mutations: {},
  getters: {
    getUserInfoUpdateForm(state) {
      return state.modalForm;
    }
  },
  actions: {
    updateUserInformation(ctx, data) {
      const config = {headers: {'Content-Type': 'multipart/form-data'}}
      let UserData = new FormData()
      UserData.append('avatar', data.avatar);
      UserData.append('name', data.name);
      UserData.append('phone', data.phone);
      UserData.append('address', data.address);

      return new Promise((resolve, reject) => {
        axios.post(`/${prefix}/update`, UserData, config).then(res => {
          if (res.status === 200) {
            ctx.commit('storeCurrentUserData', res.data.user);
            resolve(res)
            return router.push({name:'User'})
          }
        }).catch(error => {
          reject(error);
        });
      })
    },
  }
}
