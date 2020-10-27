export default async (to, from, next) => {
  document.title = `${to.name} - PipeRun`

  next()
}
