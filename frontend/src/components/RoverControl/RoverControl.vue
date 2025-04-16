<template>
    <div>
        <h3>Control del Rover</h3>
        <button @click="sendCommand('M')">Mover</button>
        <button @click="sendCommand('L')">Girar Izquierda</button>
        <button @click="sendCommand('R')">Girar Derecha</button>

        <p v-if="roverPosition">
            Posición del Rover: {{ roverPosition.x }}, {{ roverPosition.y }}, {{ roverPosition.orientation }}
        </p>

        <div class="grid">
            <div v-for="row in 5" :key="row" class="row">
                <div v-for="col in 5" :key="col" class="cell">
                    <span v-if="isRoverHere(col - 1, 5 - row)">
                        {{ getRoverSymbol() }}
                    </span>
                </div>
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
                    console.log(data);
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
        getRoverSymbol() {
            if (!this.roverPosition) return '🚀';
            switch (this.roverPosition.orientation) {
                case 'N': return '🔼';
                case 'E': return '▶️';
                case 'S': return '🔽';
                case 'W': return '◀️';
                default: return '🚀';
            }
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
