import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'

export default defineConfig({
  plugins: [
    vue(),
    // vueDevTools(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    },
  },
  server: {
    host: '0.0.0.0', // Esto permite que se acceda desde fuera del contenedor
    port: 5173,
    strictPort: true,
    watch: {
      usePolling: true, // Importante para cambios en archivos dentro del contenedor
    },
    cors: true,
  },
})
