// Importamos la función createApp de Vue para crear nuestra aplicación
import { createApp } from 'vue';

// Importamos el componente raíz de la aplicación, que es App.vue
import App from './App.vue';

// Importamos el router, que gestiona las rutas de la aplicación
import router from './router';

// Creamos la instancia de la aplicación Vue
const app = createApp(App);

// Aplicamos el router a nuestra aplicación para habilitar la navegación entre componentes
app.use(router);  // El router debe ser usado para que las rutas funcionen

// Montamos la aplicación en el DOM. Esto coloca la app en un elemento con id "app"
app.mount('#app');
