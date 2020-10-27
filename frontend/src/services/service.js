export default class Service {
  constructor (options) {
    this.options = options
  }

  static build (options) {
    return new this(options)
  }
}
