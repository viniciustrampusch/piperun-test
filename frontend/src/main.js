import Vue from 'vue'
import App from './App'
import axios from 'axios'
import router from './router'
import VueToast from 'vue-toast-notification'

import 'bootstrap/dist/css/bootstrap.min.css'
import 'vue-toast-notification/dist/theme-default.css'

Vue.config.productionTip = false
Vue.prototype.$http = axios

Vue.use(VueToast)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
