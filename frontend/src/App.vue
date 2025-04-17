<template>
  <div>
    <!-- Solo muestra el link si NO estamos ya en /control-rover -->
    <router-link v-if="$route.path !== '/control-rover'" to="/control-rover">
      Control del Rover
    </router-link>

    <router-view></router-view>
  </div>
</template>
<style>
body {
  margin: 0;
}
</style>
