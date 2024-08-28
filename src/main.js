import { createApp } from 'vue';
import './style.css';
import App from './App.vue';
import { CkeditorPlugin } from '@ckeditor/ckeditor5-vue';

createApp(App).use(CkeditorPlugin).mount('#app');
