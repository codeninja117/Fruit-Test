import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import Vue3Toastify, { type ToastContainerOptions } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const app = createApp(App);

app.use(Vue3Toastify, {
   autoClose: 3000,
   theme: 'dark',
   position: 'top-left',
   transition: 'zoom'
} as ToastContainerOptions);

app.mount('#app')
