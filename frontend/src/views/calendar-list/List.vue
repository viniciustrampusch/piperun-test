<template>
  <main>
    <loading :active.sync="isLoading" :is-full-page="true"></loading>
    <div class="container-fluid">
      <div class="row mt-4">
          <div class="col-8 offset-2">
            <h2 v-if="user && requested && user.id === requested.id">Meus agendamentos</h2>
            <h2 v-else>Agendamentos de {{requested ? requested.name : ''}}</h2>
            <form class="form-inline mt-3 mb-3">
              <div class="form-group mb-2">
                <label for="start_at" class="sr-only">De</label>
                <input type="date" class="form-control" id="start_at" v-model="params.start_at">
              </div>
              <div class="form-group mx-sm-3 mb-2">
                <label for="end_at" class="sr-only">Até</label>
                <input type="date" class="form-control" id="end_at" v-model="params.end_at">
              </div>
              <button type="submit" class="btn mb-2" @click.prevent="search()">Buscar</button>
              <button type="submit" class="btn mb-2 btn-register" @click.prevent="enter()">Novo Agendamento</button>
            </form>
            <table class="table table-bordered table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>Data de início</th>
                  <th>Data de fim</th>
                  <th>Duração</th>
                  <th v-if="user">Pauta</th>
                  <th v-if="user">Solicitante</th>
                  <th>Solicitado</th>
                  <th v-if="user">Status</th>
                  <th v-if="user && requested && user.id === requested.id">Moderar</th>
                  <th v-if="user && user.role === 'admin'">Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item of list" :key="item.id">
                  <td>{{item.start_at.date | moment("DD/MM/YYYY")}} {{item.start_at.time}}</td>
                  <td>{{item.end_at.date | moment("DD/MM/YYYY")}} {{item.end_at.time}}</td>
                  <td>{{ parseInt(item.runtime / 60)}} hora(s) e {{item.runtime % 60}} minutos</td>
                  <td v-if="user">{{item.description}}</td>
                  <td v-if="user">{{item.requester.name}}</td>
                  <td>{{item.requested.name}}</td>
                  <td v-if="user">{{item.status}}</td>
                  <td v-if="user && user.id === requested.id">
                    <a href="#" @click.prevent="moderate('approved', item.id)" class="btn btn-approve" title="Aprovar" v-if="item.status === 'Pendente'">
                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-check-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9.854-2.854a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                      </svg>
                    </a>
                    <a href="#" @click.prevent="moderate('reproved', item.id)" class="btn btn-reproved" v-if="item.status === 'Pendente'">
                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-dash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5-.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
                      </svg>
                    </a>
                  </td>
                  <td v-if="user && user.role === 'admin'">
                    <a href="#" @click.prevent="edita(item.id)" class="btn btn-edit" title="Editar">
                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg>
                    </a>
                    <a href="#" @click.prevent="remove(item.id)" class="btn btn-remove" title="Remover">
                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                      </svg>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
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
  name: 'List',
  components: {
    Loading
  },
  data () {
    return {
      isLoading: false,
      requested: null,
      params: {
        start_at: '',
        end_at: ''
      },
      list: []
    }
  },
  computed: {
    user: function () { return this.$store.getters.getUser }
  },
  mounted () {
    this.$http.get(`${baseURI}/users/${this.$route.params.user}`)
      .then((result) => {
        this.requested = result.data.data
      })

    this.search()
  },
  methods: {
    search () {
      this.isLoading = true
      this.$http.get(`${baseURI}/calendars/user/${this.$route.params.user}`, { params: this.params })
        .then((result) => {
          this.list = result.data.data
          this.isLoading = false
        })
    },
    enter (userId) {
      this.$router.push(`/calendar/${this.requested.id}`)
    },
    moderate (slugStatus, calendarId) {
      this.$http.patch(`${baseURI}/calendars/${calendarId}`, {
        slug: slugStatus
      }, {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
      })
        .then((result) => {
          this.search()
        })
    },
    remove (calendarId) {
      this.$http.delete(`${baseURI}/calendars/${calendarId}`, {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
      })
        .then((result) => {
          this.search()
        })
    },
    edit (calendarId) {
      this.$router.push(`/calendar/${this.requested.id}/${calendarId}`)
    }
  }
}
</script>

<style scoped>
  input {
    border-color: #222;
  }
  button {
    background: #fff;
    color: #222;
    border: 1px solid #222;
  }
  button:hover, button:active {
    background: #222;
    color: #fff;
  }
  .btn {
    font-size: 22px;
  }
  .btn-remove, .btn-reproved {
    color: red;
  }
  .btn-approve {
    color: green;
  }
  .btn-register {
    position: absolute;
    right: 15px;
  }
</style>
