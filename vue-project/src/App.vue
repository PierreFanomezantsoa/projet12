<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import View from './views/medicines/View.vue'

</script>

<template>
  <header>
    <div class="wrapper" style="height: 60px;">

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 50px;">
  <div class="container-fluid">
    <img style="background-color: black; position: absolute;left: 100px; z-index: 2; height: 45px;" src="image/medecine.png" alt="">
     <h4 style="text-align: center; position: absolute; left: 500px; color: white;">GESTION DES MEDECINE</h4>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    </div>
  </div>
</nav>
      <nav>
        
      </nav>
    </div>
  </header>
  <RouterLink style="background-color: gray;
   width: 240px;height: 240px;
    position: absolute;bottom: 400px;
    border-radius: 7px; 
    left: 50px; text-align: center; color: aliceblue; font-size: 15px;" class="navbar-brand" to="/about"><img src="image/Home2.PNG" style="width: 94px; height: 94px; margin-top: 27px;" alt=""><h3> Accueil</h3></RouterLink>
  <RouterLink style="background-color: gray;
  border-radius: 7px;
  width: 240px;height: 240px; position: absolute;
  bottom: 100px; left: 50px; text-align: center; color: aliceblue; font-size: 16px" class="nav-link active" aria-current="page" to="/medicines"><img style="width: 94px; height: 94px; color: aliceblue; margin-top: 27px;" src="image/pharma.png" alt=""><h4> Liste de Medicine</h4></RouterLink>
  <RouterView />
</template>

<style scoped>

</style>
