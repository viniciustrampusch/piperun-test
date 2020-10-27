import { routes as login } from '../views/login'
import { routes as home } from '../views/home'
import { routes as calendar } from '../views/calendar'

export default [
  ...login,
  ...home,
  ...calendar
]
