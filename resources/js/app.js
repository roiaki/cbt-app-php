require('./bootstrap');
require('./main');

import { createApp } from 'vue'
import TestVue from './components/TestVue.vue';
//import App from './App.vue'
//import UserInformation from './components/UserInformation.vue'
import ExampleComponent from './components/ExampleComponent.vue';
import AddInputForm from './components/AddInputForm.vue';
import AddSolution from './components/AddSolution.vue';

const app = createApp({})
app.component('test-vue', TestVue);
app.component('example-component', ExampleComponent);
app.component('add', AddInputForm);
app.component('addsolution', AddSolution);

app.mount('#app')