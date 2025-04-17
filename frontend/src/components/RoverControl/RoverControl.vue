<template>
  <div class="wrapper">
    <!-- Título principal de la aplicación de control del rover -->
    <h1 class="title">🚀 Rover Control Center - Mars Mission</h1>

    <div class="map-screen">
      <!-- Grilla que representa el mapa en donde se mueve el rover -->
      <div class="grid">
        <!-- Renderiza las filas de la grilla, en este caso una grilla de 5x5 -->
        <div v-for="row in 5" :key="row" class="row">
          <!-- Renderiza las celdas de la grilla, representando cada casilla -->
          <div v-for="col in 5" :key="col" class="cell">
            <!-- Verifica si el rover está en la posición actual y lo muestra -->
            <span v-if="isRoverHere(col - 1, 5 - row)">
              <img class="rover" :src="getRoverIcon()" alt="Rover" />
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="controls">
      <!-- Controles para mover el rover -->
      <div class="joystick">
        <div class="joystick-row">
          <!-- Botón para avanzar el rover -->
          <button class="btn control-btn" @click="sendCommand('M')" title="Avanzar">
            ▲
          </button>
        </div>
        <div class="joystick-row">
          <!-- Botones para girar el rover a la izquierda o derecha -->
          <button class="btn control-btn" @click="sendCommand('L')" title="Girar Izquierda">
            ◀
          </button>
          <!-- Botón central, deshabilitado, que puede usarse en el futuro para más funciones -->
          <button class="btn control-center" disabled>
            ●
          </button>
          <button class="btn control-btn" @click="sendCommand('R')" title="Girar Derecha">
            ▶
          </button>
        </div>
      </div>

      <!-- Panel de información sobre el estado del rover -->
      <div class="info-panel" v-if="roverPosition">
        <!-- Muestra las coordenadas y la dirección del rover -->
        <p><strong>Coordenadas:</strong> X: {{ roverPosition.x }} | Y: {{ roverPosition.y }}</p>
        <p><strong>Dirección:</strong> {{ fullOrientation }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
data() {
  return {
    roverPosition: null,  // Guarda la posición actual del rover
  };
},
computed: {
  // Computed property que devuelve la orientación en formato más legible
  fullOrientation() {
    switch (this.roverPosition?.orientation) {
      case 'N': return 'Norte (↑)';
      case 'S': return 'Sur (↓)';
      case 'E': return 'Este (→)';
      case 'W': return 'Oeste (←)';
      default: return '';  // Si no hay orientación válida, devuelve una cadena vacía
    }
  },
},
methods: {
  // Envia un comando al backend para mover el rover
  async sendCommand(command) {
    try {
      // Enviar la solicitud al backend para mover el rover según el comando
      const response = await fetch(`http://localhost:8080/index.php?command=${command}`, {
        method: 'POST',
        credentials: 'include',  // Incluye las cookies (sesiones)
      });
      const data = await response.json();
      // Si la respuesta no tiene errores, actualiza la posición del rover
      if (!data.error) {
        this.roverPosition = data;
      } else {
        alert(data.error);  // Muestra el error si ocurre
      }
    } catch (error) {
      console.error('Error al controlar el rover:', error);  // En caso de error en la comunicación con el backend
    }
  },
  // Obtiene la posición inicial del rover desde el backend
  async fetchInitialPosition() {
    try {
      const response = await fetch('http://localhost:8080/index.php?command=GET', {
        method: 'GET',
        credentials: 'include',
      });
      const data = await response.json();
      // Si no hay error, establece la posición inicial
      if (!data.error) {
        this.roverPosition = data;
      }
    } catch (error) {
      console.error('Error al obtener la posición inicial:', error);  // En caso de error en la comunicación con el backend
    }
  },
  // Función para determinar si el rover está en una celda específica
  isRoverHere(x, y) {
    return this.roverPosition && this.roverPosition.x === x && this.roverPosition.y === y;
  },
  // Retorna la URL de la imagen del rover según su orientación
  getRoverIcon() {
    if (!this.roverPosition) return '';  // Si no hay posición, no se puede mostrar la imagen
    const dir = this.roverPosition.orientation;  // Orientación actual del rover
    // Devuelve la URL de la imagen correspondiente a la orientación
    return new URL(`../../assets/rover-${dir.toLowerCase()}.png`, import.meta.url).href;
  },
},
mounted() {
  // Al montar el componente, obtener la posición inicial del rover
  this.fetchInitialPosition();
},
};

</script>

<style scoped>
@import './RoverControl.css';  
</style>
