import axios from 'axios';  // Importa la librería axios para realizar solicitudes HTTP

// Crea una instancia personalizada de axios con configuración predeterminada
const api = axios.create({
  baseURL: 'http://localhost:8000/mi-proyecto/backend/public',  // URL base del backend. Se ajusta a tu entorno de desarrollo
  timeout: 1000,  // Tiempo máximo de espera para una solicitud (en milisegundos)
});

export default api;  // Exporta la instancia de axios para ser utilizada en otras partes de la aplicación
