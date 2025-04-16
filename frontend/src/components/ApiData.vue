<template>
    <div>
        <h1>{{ message }}</h1>
        <button @click="getData">Obtener Datos</button>
    </div>
</template>

<script>
import api from '../api';

export default {
    data() {
        return {
            message: ''
        };
    },
    methods: {
        async getData() {
            try {
                const response = await api.get('/');
                this.message = response.data.message;  // Mostrar el mensaje de la API
            } catch (error) {
                console.error('Error al obtener los datos', error);
            }
        }
    }
};
</script>

<style scoped>
/* Aquí puedes agregar el estilo */
</style>
