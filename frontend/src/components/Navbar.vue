<template>
  <header>
      <div class="container-fluid">
        <div class="row">
          <div class="col-2">
            <router-link to="/">
              <img
                src="https://crmpiperun.com/wp-content/uploads/2019/01/piperun-sistema-crm-vendas.png"
                alt="Logotipo"
              />
            </router-link>
          </div>
          <div class="col-1 offset-9">
            <router-link to="/login">
              <button class="btn float-right">Entrar</button>
            </router-link>
          </div>
        </div>
      </div>
    </header>
</template>

<script>
export default {
  name: 'Navbar'
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
</style>
