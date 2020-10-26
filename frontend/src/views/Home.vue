<template>
  <div>
    <Header></Header>
    <main>
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-2" v-for="user of users" :key="user.id">
            <div class="card mb-4 shadow-sm">
              <div class="card-body">
                <p class="card-text text-center h2">
                  {{user.name}}
                </p>
                <button class="btn btn-calendar" @click="enter(user.id)">
                  Acessar agenda
                </button>
              </div>
            </div>
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
      users: []
    }
  },
  created () {
    document.title += '  - Home'
  },
  mounted () {
    const baseURI = 'http://127.0.0.1:8000/api/users'
    this.$http.get(baseURI)
      .then((result) => {
        this.users = result.data.data
      })
  },
  methods: {
    enter (userId) {
      this.$router.push(`/calendar/${userId}`)
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
  .card {
    border-color: #222;
  }
  .btn-calendar {
    width: 100%;
  }
</style>
