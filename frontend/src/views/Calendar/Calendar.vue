<template>
  <main>
    <loading :active.sync="isLoading" :is-full-page="true"></loading>
    <div class="container-fluid">
      <div class="row mt-4">
          <div class="col-6 offset-3">
            <h2>Agendamento para {{requested.name}}</h2>
            <form class="mt-4">
              <div class="alert alert-danger" v-show="errorMessage" v-html="errorMessage"></div>
              <div class="form-group" v-if="!isLoggedIn">
                <label for="name">Seu Nome</label>
                <input type="text" class="form-control" id="name" v-model="calendar.customer_name">
              </div>
              <div class="form-group" v-if="!isLoggedIn">
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
</template>

<script>
import Loading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css'
const baseURI = `http://127.0.0.1:8000/api`
export default {
  name: 'Calendar',
  components: {
    Loading
  },
  data () {
    return {
      isLoading: false,
      errorMessage: '',
      requested: {
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
  computed: {
    isLoggedIn: function () { return this.$store.getters.isLoggedIn },
    user: function () { return this.$store.getters.getUser }
  },
  mounted () {
    this.clearForm()

    this.$http.get(`${baseURI}/users/${this.$route.params.user}`)
      .then((result) => {
        this.requested = result.data.data
      })

    if (this.$route.params.calendar) {
      this.$http.get(`${baseURI}/calendars/${this.$route.params.calendar}`)
        .then(this.populate)
    }
  },
  methods: {
    save () {
      this.calendar.requested_id = this.requested.id
      this.isLoading = true
      this.errorMessage = ''

      if (this.isLoggedIn) {
        this.calendar.requester_id = this.user.id
      }

      if (this.calendar.id) {
        this.$http.put(`${baseURI}/calendars/${this.calendar.id}`, this.calendar, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
          }
        })
          .then(this.registerSuccess)
          .catch(this.registerError)
      } else {
        this.$http.post(`${baseURI}/calendars`, this.calendar)
          .then(this.registerSuccess)
          .catch(this.registerError)
      }
    },
    populate (result) {
      this.calendar = {
        id: result.data.data.id,
        start_at: result.data.data.start_at.date,
        start_at_time: result.data.data.start_at.time,
        end_at: result.data.data.end_at.date,
        end_at_time: result.data.data.end_at.time,
        description: result.data.data.description,
        customer_name: result.data.data.requester.name,
        customer_email: result.data.data.requester.email,
        requested_id: result.data.data.requested.id
      }
    },
    clearForm () {
      this.calendar = {
        id: null,
        start_at: '',
        start_at_time: '',
        end_at: '',
        end_at_time: '',
        description: '',
        customer_name: '',
        customer_email: '',
        requested_id: ''
      }
      this.errorMessage = ''
    },
    registerSuccess (response) {
      this.isLoading = false
      this.$toast.open({
        message: 'Salvo com sucesso',
        type: 'success',
        position: 'top-right'
      })

      this.clearForm()
    },
    registerError (error) {
      for (let key in error.response.data.error) {
        let message = error.response.data.error[key]

        if (Array.isArray(error.response.data.error[key])) {
          message = error.response.data.error[key][0]
        }

        this.errorMessage += `${message}<br/>`
      }

      this.isLoading = false
      this.$toast.open({
        message: 'Ocorreu um erro ao salvar',
        type: 'error',
        position: 'top-right'
      })
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
