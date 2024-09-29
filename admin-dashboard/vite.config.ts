import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  base: '/', // укажите базовый путь вашего приложения
  server: {
    host: '0.0.0.0', // это важно для доступа из контейнера
    port: 8086,      // порт, который будет использоваться
  },
});
