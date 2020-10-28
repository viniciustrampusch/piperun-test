export default [
  {
    path: '/list/:user',
    name: 'Calendar list',
    component: () => import(/* webpackChunkName: "calendar" */ './List')
  }
]
