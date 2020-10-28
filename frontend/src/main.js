import Vue from 'vue'
import App from './App'
import axios from 'axios'
import router from './router'
import store from './store/index'
import VueToast from 'vue-toast-notification'

import 'bootstrap/dist/css/bootstrap.min.css'
import 'vue-toast-notification/dist/theme-default.css'

Vue.config.productionTip = false
Vue.prototype.$http = axios

const token = localStorage.getItem('token')

if (token) {
  Vue.prototype.$http.defaults.headers.common['Authorization'] = token
}

Vue.use(VueToast)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
