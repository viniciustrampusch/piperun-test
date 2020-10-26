import Vue from 'vue'
import VueToast from 'vue-toast-notification'
import Router from 'vue-router'
import Home from '@/views/Home'
import Calendar from '@/views/Calendar'
import Login from '@/views/Login'
import 'vue-toast-notification/dist/theme-default.css'

Vue.use(Router)
Vue.use(VueToast)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/calendar/:user',
      name: 'New register',
      component: Calendar
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    }
  ]
})
