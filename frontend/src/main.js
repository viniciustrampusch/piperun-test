import Vue from 'vue'
import App from './App'
import router from './router'
import VueToast from 'vue-toast-notification'

import 'bootstrap/dist/css/bootstrap.min.css'
import 'vue-toast-notification/dist/theme-default.css'

Vue.config.productionTip = false

Vue.use(VueToast)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
