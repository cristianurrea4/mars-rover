<template>
    <div class="wrapper">
      <h1 class="title">🚀 Rover Control Center - Mars Mission</h1>
  
      <div class="map-screen">
        <div class="grid">
          <div v-for="row in 5" :key="row" class="row">
            <div v-for="col in 5" :key="col" class="cell">
              <span v-if="isRoverHere(col - 1, 5 - row)">
                <img class="rover" :src="getRoverIcon()" alt="Rover" />
              </span>
            </div>
          </div>
        </div>
      </div>
  
      <div class="controls">
        <div class="joystick">
          <div class="joystick-row">
            <button class="btn control-btn" @click="sendCommand('M')" title="Avanzar">
              ▲
            </button>
          </div>
          <div class="joystick-row">
            <button class="btn control-btn" @click="sendCommand('L')" title="Girar Izquierda">
              ◀
            </button>
            <button class="btn control-center" disabled>
              ●
            </button>
            <button class="btn control-btn" @click="sendCommand('R')" title="Girar Derecha">
              ▶
            </button>
          </div>
        </div>
  
        <div class="info-panel" v-if="roverPosition">
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
        roverPosition: null,
      };
    },
    computed: {
      fullOrientation() {
        switch (this.roverPosition?.orientation) {
          case 'N': return 'Norte (↑)';
          case 'S': return 'Sur (↓)';
          case 'E': return 'Este (→)';
          case 'W': return 'Oeste (←)';
          default: return '';
        }
      },
    },
    methods: {
      async sendCommand(command) {
        try {
          const response = await fetch(`http://localhost:8080/index.php?command=${command}`, {
            method: 'POST',
            credentials: 'include',
          });
          const data = await response.json();
          if (!data.error) {
            this.roverPosition = data;
          } else {
            alert(data.error);
          }
        } catch (error) {
          console.error('Error al controlar el rover:', error);
        }
      },
      async fetchInitialPosition() {
        try {
          const response = await fetch('http://localhost:8080/index.php?command=GET', {
            method: 'GET',
            credentials: 'include',
          });
          const data = await response.json();
          if (!data.error) {
            this.roverPosition = data;
          }
        } catch (error) {
          console.error('Error al obtener la posición inicial:', error);
        }
      },
      isRoverHere(x, y) {
        return this.roverPosition && this.roverPosition.x === x && this.roverPosition.y === y;
      },
      getRoverIcon() {
        if (!this.roverPosition) return '';
        const dir = this.roverPosition.orientation;
        return new URL(`../../assets/rover-${dir.toLowerCase()}.png`, import.meta.url).href;
      },
    },
    mounted() {
      this.fetchInitialPosition();
    },
  };
  </script>
  
  <style scoped>
  @import './RoverControl.css';
  </style>
  