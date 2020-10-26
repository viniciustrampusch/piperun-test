<template>
  <div>
    <Header></Header>
    <main>
      <loading :active.sync="isLoading" :is-full-page="true"></loading>
      <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-6 offset-3">
              <h2>Agendamento para {{user.name}}</h2>
              <form class="mt-4">
                <div class="alert alert-danger" v-show="error_message" v-html="error_message"></div>
                <div class="form-group">
                  <label for="name">Seu Nome</label>
                  <input type="text" class="form-control" id="name" v-model="calendar.customer_name">
                </div>
                <div class="form-group">
                  <label for="email">Seu E-mail</label>
                  <input type="email" class="form-control" id="email" v-model="calendar.customer_email">
                </div>
                <div class="form-group datetime-group">
                  <div class="column float-left">
                    <label for="start_at">Data de início</label>
                    <input type="date" class="form-control" id="start_at" v-model="calendar.start_at">
                  </div>
                  <div class="column float-right">
                    <label for="start_at_time">Hora de início</label>
                    <select class="form-control" id="start_at_time" v-model="calendar.start_at_time">
                      <option value="08:00:00">8 horas</option>
                      <option value="09:00:00">9 horas</option>
                      <option value="10:00:00">10 horas</option>
                      <option value="11:00:00">11 horas</option>
                      <option value="12:00:00">12 horas</option>
                      <option value="13:00:00">13 horas</option>
                      <option value="14:00:00">14 horas</option>
                      <option value="15:00:00">15 horas</option>
                      <option value="16:00:00">16 horas</option>
                      <option value="17:00:00">17 horas</option>
                      <option value="18:00:00">18 horas</option>
                    </select>
                  </div>
                </div>
                <div class="form-group datetime-group">
                  <div class="column float-left">
                    <label for="end_at">Data de fim</label>
                    <input type="date" class="form-control" id="end_at" v-model="calendar.end_at">
                  </div>
                  <div class="column float-right">
                    <label for="end_at_time">Hora de fim</label>
                    <select class="form-control" id="end_at_time" v-model="calendar.end_at_time">
                      <option value="08:00:00">8 horas</option>
                      <option value="09:00:00">9 horas</option>
                      <option value="10:00:00">10 horas</option>
                      <option value="11:00:00">11 horas</option>
                      <option value="12:00:00">12 horas</option>
                      <option value="13:00:00">13 horas</option>
                      <option value="14:00:00">14 horas</option>
                      <option value="15:00:00">15 horas</option>
                      <option value="16:00:00">16 horas</option>
                      <option value="17:00:00">17 horas</option>
                      <option value="18:00:00">18 horas</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="description">Pauta</label>
                  <textarea class="form-control" id="description" rows="3" v-model="calendar.description"></textarea>
                </div>
                <button type="submit" class="btn m0 float-right" @click.prevent="save()">Agendar</button>
              </form>
            </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import Header from '../components/Header'
import Loading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css'

export default {
  name: 'Home',
  components: {
    Header,
    Loading
  },
  data () {
    return {
      isLoading: false,
      error_message: '',
      user: {
        id: '',
        name: '',
        email: ''
      },
      calendar: {
        start_at: '',
        start_at_time: '',
        end_at: '',
        end_at_time: '',
        description: '',
        customer_name: '',
        customer_email: '',
        requested_id: ''
      }
    }
  },
  created () {
    document.title += '  - Home'
  },
  mounted () {
    this.clearForm()
    const baseURI = `http://127.0.0.1:8000/api/users/${this.$route.params.user}`

    this.$http.get(baseURI)
      .then((result) => {
        this.user = result.data.data
      })
  },
  methods: {
    save () {
      const baseURI = `http://127.0.0.1:8000/api/calendars`
      this.calendar.requested_id = this.user.id
      this.isLoading = true
      this.error_message = ''

      this.$http.post(baseURI, this.calendar)
        .then((result) => {
          this.isLoading = false
          this.$toast.open({
            message: 'Salvo com sucesso',
            type: 'success',
            position: 'top-right'
          })

          this.clearForm()
        })
        .catch((error) => {
          for (let err in error.response.data.error) {
            let message = error.response.data.error[err]

            if (Array.isArray(error.response.data.error[err])) {
              message = error.response.data.error[err][0]
            }

            this.error_message += `${message}<br/>`
          }

          this.isLoading = false
          this.$toast.open({
            message: 'Ocorreu um erro ao salvar',
            type: 'error',
            position: 'top-right'
          })
        })
    },
    clearForm () {
      this.calendar = {
        start_at: '',
        start_at_time: '',
        end_at: '',
        end_at_time: '',
        description: '',
        customer_name: '',
        customer_email: '',
        requested_id: ''
      }
      this.error_message = ''
    }
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
