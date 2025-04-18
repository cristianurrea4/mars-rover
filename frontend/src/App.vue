<template>
  <div class="home-container" v-if="$route.path !== '/control-rover'">
    <button class="rover-btn" @click="$router.push('/control-rover')">
      Ingresar al Control del Rover
    </button>
  </div>

  <router-view></router-view>
</template>

<style src="./App.css"></style>
