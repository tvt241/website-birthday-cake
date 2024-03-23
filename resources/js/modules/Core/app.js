import "~/Core/bootstrap";
import { createApp } from 'vue'
import App from '~/Core/App.vue';
import i18n from "~/Core/i18n";
import { createPinia } from "pinia";

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import LoadingComponent from "~/Core/components/LoadingComponent.vue";

// import VueSweetalert2 from 'vue-sweetalert2';
// import 'sweetalert2/dist/sweetalert2.min.css';

const optionsToast = {
};


const optionsSweetAlert = {
};


const pinia = createPinia()

const app = createApp(App);
app.component(LoadingComponent);
app.use(i18n);
app.use(pinia);
app.use(Toast, optionsToast);
// app.use(VueSweetalert2, optionsSweetAlert);
export {
    app
}