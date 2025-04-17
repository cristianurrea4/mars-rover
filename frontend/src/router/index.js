import { createRouter, createWebHistory } from 'vue-router';  // Importa las funciones necesarias para crear un router en Vue.js
import RoverControl from '../components/RoverControl/RoverControl.vue';  // Importa el componente de control del rover

// Define las rutas para la aplicación
const routes = [
    {
        path: '/control-rover',  // Ruta para el control del rover
        name: 'ControlRover',  // Nombre de la ruta
        component: RoverControl  // El componente que se renderiza cuando se accede a esta ruta
    }
];

// Crea el objeto router utilizando la historia del navegador
const router = createRouter({
    // Usa la variable de entorno VITE_BASE_URL para establecer la base URL de la aplicación
    history: createWebHistory(import.meta.env.VITE_BASE_URL),
    routes  // Las rutas definidas anteriormente
});

export default router;  // Exporta el router para que pueda ser utilizado en la aplicación
