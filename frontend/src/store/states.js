export default {
  status: '',
  token: localStorage.getItem('token') || '',
  user: JSON.parse(localStorage.getItem('user'))
}
