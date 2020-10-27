<template>
  <main>
    <div class="container-fluid">
      <div class="row mt-4">
          <div class="col-6 offset-3">
            <h2>Login</h2>
            <form class="mt-4">
              <div class="form-group">
                <label for="name">Seu e-mail</label>
                <input type="text" class="form-control" id="name" v-model="form.email">
              </div>
              <div class="form-group">
                <label for="password">Sua senha</label>
                <input type="password" class="form-control" id="password" v-model="form.password">
              </div>
              <button type="submit" class="btn m0 float-right">Entrar</button>
            </form>
          </div>
      </div>
    </div>
  </main>
</template>

<script>

export default {
  name: 'Login',
  data () {
    return {
      form: {
        email: '',
        password: ''
      }
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
