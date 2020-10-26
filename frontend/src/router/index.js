import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/views/Home'
import Calendar from '@/views/Calendar'

Vue.use(Router)

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
    }
  ]
})
