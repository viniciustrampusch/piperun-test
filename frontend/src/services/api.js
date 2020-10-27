import Http from './http'

export default class Api extends Http {
  static base = '/api'

  static build (path = '', options = {}, http = null) {
    return new this(Api.normalize(Api.base, path), options, http)
  }
}
