import axios from "axios";
import { getItem } from "../composables/useLocalStorage";
import ENV from "../config/env";
import i18n from "../i18n";
import alertHelper from "../helpers/alertHelper";
import { useLoadingStore } from "../stores/loadingStore";


const store = useLoadingStore();

const instance = axios.create({
    baseURL: ENV.API_URL,
    headers: {
        // "X-Locale": i18n.global.locale,
        "X-Locale": "vi",
        "Content-Type": "application/json",
        "X-DateTime": ENV.DATE_V1,
        "Authorization": `Bearer ${ getItem("token") }`
    },
    timeout: 3000,
});

instance.interceptors.request.use((config) => {
    store.showLoading();
    return config;
});
  

instance.interceptors.response.use(
    (response) => {
        store.hideLoading();
        if (response.status === 200) {
            const method = response.config.method;
            if(method == "post"){
                alertHelper.success("Thêm thành công");
            }
            else if(method == "put"){
                alertHelper.success("Cập nhật thành công");
            }
            return response.data;
        }
        return Promise.reject(response);
    },
    (error) => {
        store.hideLoading();
        if (error) {
            if (error.response && error.response.status === 401) {
                msg = error.response.data.msg;
                return;
            }
            const method = error.response.config.method;
            const message = error.response.data.message
            if(method == "post"){
                alertHelper.error("Thêm thất bại", message);
            }
            else if(method == "put"){
                alertHelper.error("Cập nhật thất bại", message);
            }
        }
        return Promise.reject(error);
    }
);

export default instance;
