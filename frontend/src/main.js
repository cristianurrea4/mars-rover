// frontend/src/main.js
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'  // Importar el router

// Crear la aplicación y usar el router
const app = createApp(App)
app.use(router)  // Aplicar el router

// Montar la aplicación en el DOM
app.mount('#app')
