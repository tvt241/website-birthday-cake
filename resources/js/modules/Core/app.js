import "~/Core/bootstrap";
import { createApp } from 'vue'
import App from '~/Core/App.vue';
import i18n from "~/Core/i18n";
import { createPinia } from "pinia";
import "vue-toastification/dist/index.css";
import Toast from "vue-toastification";
import LoadingComponent from "~/Core/components/LoadingComponent.vue";
import CKEditor from '@ckeditor/ckeditor5-vue';

const pinia = createPinia();

const app = createApp(App);
app.component(LoadingComponent);
app.use(i18n);
app.use(Toast);
app.use(pinia);
app.use(CKEditor);
export {
    app
}