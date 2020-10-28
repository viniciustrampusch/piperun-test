import store from '../store'

export default async (to, from, next) => {
  document.title = `${to.name} - PipeRun`

  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (store.getters.isLoggedIn) {
      next()
      return
    }
    next('/login')
  } else {
    next()
  }
}
