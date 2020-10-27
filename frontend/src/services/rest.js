import Api from './api'

export default class Rest extends Api {
  static resource = ''
  id = 'id'

  constructor (resource, options = {}, http = null) {
    super(Rest.normalize(Rest.base, resource), options, http)
  }

  static build () {
    return new this(this.resource)
  }

  create (record) {
    return this.post('', record)
  }

  read (id) {
    return this.get(`/${id}`)
  }

  update (record) {
    return this.patch(`/${this.getId(record)}`, record)
  }

  destroy (record) {
    return this.delete(`/${this.getId(record)}`)
  }

  search (parameters = {}) {
    const queryString = ''
    return this.get(`?${queryString}`).then(response => ({
      data: response.data
    }))
  }

  getId (record) {
    if (typeof record === 'object') {
      return record[this.id]
    }
    return String(record)
  }
}
