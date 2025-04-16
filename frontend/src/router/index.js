import { createRouter, createWebHistory } from 'vue-router';
import RoverControl from '../components/RoverControl/RoverControl.vue';

// Usa la variable de entorno definida en .env
const routes = [
    {
        path: '/control-rover',
        name: 'ControlRover',
        component: RoverControl
    }
];

const router = createRouter({
    // Aquí usamos la variable de entorno VITE_BASE_URL
    history: createWebHistory(import.meta.env.VITE_BASE_URL),
    routes
});

export default router;
