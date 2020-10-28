import { routes as login } from '../views/login'
import { routes as home } from '../views/home'
import { routes as calendar } from '../views/calendar'
import { routes as list } from '../views/calendar-list'

export default [
  ...login,
  ...home,
  ...calendar,
  ...list
]
