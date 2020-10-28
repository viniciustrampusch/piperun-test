import axios from 'axios'

export const Login = ({ commit }, user) => {
  return new Promise((resolve, reject) => {
    commit('auth_request')
    axios({ url: 'http://127.0.0.1:8000/api/auth/login', data: user, method: 'POST' })
      .then(resp => {
        const token = resp.data.access_token
        const user = resp.data.user
        localStorage.setItem('token', token)
        localStorage.setItem('user', JSON.stringify(user))
        axios.defaults.headers.common['Authorization'] = token
        commit('auth_success', token, user)
        resolve(resp)
      })
      .catch(err => {
        commit('auth_error')
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        reject(err)
      })
  })
}

export const Logout = ({ commit }) => {
  return new Promise((resolve, reject) => {
    commit('logout')
    localStorage.removeItem('token')
    localStorage.removeItem('user')
    delete axios.defaults.headers.common['Authorization']
    resolve()
  })
}
