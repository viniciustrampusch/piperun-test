import standard from './standard'
import Service from './service'

export default class Http extends Service {
  constructor (path, options = {}, http = null) {
    super(options)
    this.path = path
    this.http = http || standard
  }

  static build (path, options) {
    return new this(path, options)
  }

  get (url) {
    return this.http
      .get(this.constructor.normalize(this.path, url))
      .then(this.constructor.then)
  }

  post (url, data) {
    return this.http
      .post(this.constructor.normalize(this.path, url), data)
      .then(this.constructor.then)
  }

  put (url, data) {
    return this.http
      .put(this.constructor.normalize(this.path, url), data)
      .then(this.constructor.then)
  }

  patch (url, data) {
    return this.http
      .patch(this.constructor.normalize(this.path, url), data)
      .then(this.constructor.then)
  }

  delete (url) {
    return this.http
      .delete(this.constructor.normalize(this.path, url))
      .then(this.constructor.then)
  }

  static then (response) {
    if (!response.data) {
      return {}
    }
    if (typeof response.data === 'string') {
      return JSON.parse(response.data)
    }
    return response.data
  }

  static normalize (start, end) {
    return `${start}/${end}`.replace(/([^:]\/)\/+/g, '$1')
  }
}
