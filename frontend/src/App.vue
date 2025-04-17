<template>
  <div>
    <!-- Solo muestra el link si NO estamos ya en /control-rover -->
    <router-link v-if="$route.path !== '/control-rover'" to="/control-rover">
      Control del Rover
    </router-link>

    <!-- Muestra el componente que se ha asignado en la ruta actual -->
    <router-view></router-view>
  </div>
</template>

<style>
body {
  margin: 0;  /* Elimina los márgenes predeterminados del cuerpo de la página */
}
</style>
