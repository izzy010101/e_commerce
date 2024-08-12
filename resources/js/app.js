// Import Vue
import { createApp } from 'vue';
import SearchBarComponent from './components/SearchBarComponent.vue';
// Import Alpine.js
import Alpine from 'alpinejs';

//initialize Alpine
window.Alpine = Alpine;
Alpine.start();

//initialize Vue
const app = createApp({});
app.component('search-bar-component', SearchBarComponent);
app.mount('#app');
