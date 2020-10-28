export default [
  {
    path: '/calendar/:user',
    name: 'Calendar',
    component: () => import(/* webpackChunkName: "calendar" */ './Calendar')
  },
  {
    path: '/calendar/:user/:calendar',
    name: 'Calendar',
    component: () => import(/* webpackChunkName: "calendar" */ './Calendar')
  }
]
