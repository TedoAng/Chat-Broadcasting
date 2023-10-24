import './bootstrap';
import {createApp} from 'vue/dist/vue.esm-bundler.js';
import App from './App.vue';
import Admin from './components/Admin.vue';

const app = createApp({});
app.component('app-component', App);
app.component('admin-component', Admin);

app.mount("#app");