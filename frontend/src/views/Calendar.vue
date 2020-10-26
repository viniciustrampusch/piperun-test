<template>
  <div>
    <Header></Header>
    <main>
      <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-6 offset-3">
              <h2>Agendamento para {{user.name}}</h2>
              <form class="mt-4">
                <div class="form-group">
                  <label for="name">Seu Nome</label>
                  <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                  <label for="email">Seu E-mail</label>
                  <input type="email" class="form-control" id="email">
                </div>
                <div class="form-group datetime-group">
                  <div class="column float-left">
                    <label for="start_at">Data de início</label>
                    <input type="date" class="form-control" id="start_at">
                  </div>
                  <div class="column float-right">
                    <label for="start_at_time">Hora de início</label>
                    <select class="form-control" id="start_at_time">
                      <option>8 horas</option>
                      <option>9 horas</option>
                      <option>10 horas</option>
                      <option>11 horas</option>
                      <option>12 horas</option>
                      <option>13 horas</option>
                      <option>14 horas</option>
                      <option>15 horas</option>
                      <option>16 horas</option>
                      <option>17 horas</option>
                      <option>18 horas</option>
                    </select>
                  </div>
                </div>
                <div class="form-group datetime-group">
                  <div class="column float-left">
                    <label for="end_at">Data de fim</label>
                    <input type="date" class="form-control" id="end_at">
                  </div>
                  <div class="column float-right">
                    <label for="end_at_time">Hora de fim</label>
                    <select class="form-control" id="end_at_time">
                      <option>8 horas</option>
                      <option>9 horas</option>
                      <option>10 horas</option>
                      <option>11 horas</option>
                      <option>12 horas</option>
                      <option>13 horas</option>
                      <option>14 horas</option>
                      <option>15 horas</option>
                      <option>16 horas</option>
                      <option>17 horas</option>
                      <option>18 horas</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="descrption">Pauta</label>
                  <textarea class="form-control" id="descrption" rows="3"></textarea>
                </div>
                <button type="submit" class="btn m0 float-right">Agendar</button>
              </form>
            </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import Header from '../components/Header'
export default {
  name: 'Home',
  components: {
    Header
  },
  data () {
    return {
      user: {}
    }
  },
  created () {
    document.title += '  - Home'
  },
  mounted () {
    const baseURI = `http://127.0.0.1:8000/api/users/${this.$route.params.user}`
    this.$http.get(baseURI)
      .then((result) => {
        this.user = result.data.data
      })
  }
}
</script>

<style scoped>
  header {
    border-bottom: 1px solid #222;
  }
  header img {
    width: 150px;
    margin-left: 30px;
    margin-top: 5px;
  }
  button {
    margin-right: 30px;
    margin-top: 20px;
    border: 1px solid #222;
  }
  button:hover {
    background: #222;
    color: #fff;
  }
  input, textarea, select {
    border-color: #222;
  }
  .form-group {
    clear: both;
  }
  .datetime-group {
    width: 100%;
  }
  .datetime-group .column {
    width: 45%;
    margin-bottom: 15px;
  }
  .m0 {
    margin: 0;
  }
</style>
