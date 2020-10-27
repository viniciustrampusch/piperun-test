export default [
  {
    path: '/calendar/:user',
    name: 'Calendar',
    component: () => import(/* webpackChunkName: "calendar" */ './Calendar')
  }
]
