import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/mi-proyecto/backend/public', // URL del backend
  timeout: 1000,
});

export default api;
