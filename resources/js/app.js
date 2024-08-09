import { createApp } from 'vue';
import SearchBarComponent from './components/SearchBarComponent.vue';

const app = createApp({});
app.component('search-bar-component', SearchBarComponent);
app.mount('#app');
