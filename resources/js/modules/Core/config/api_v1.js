import axios from "axios";
import { getItem, removeItem } from "../helpers/localStorageHelper";
import ENV from "./env";
import i18n from "../i18n";
import alertHelper from "../helpers/alertHelper";
import { useLoadingStore } from "../stores/loadingStore";


const instance = axios.create({
    baseURL: ENV.API_URL,
    headers: {
        // "X-Locale": i18n.global.locale,
        "X-Locale": "vi",
        "Content-Type": "application/json",
        "X-DateTime": ENV.DATE_V1,
    },
    timeout: 3000,
});

instance.interceptors.request.use((config) => {
    const store = useLoadingStore();
    store.showLoading();
    config.headers.Authorization =  "Bearer " + getItem("token");
    return config;
});

instance.interceptors.response.use(
    (response) => {
        const store = useLoadingStore();
        store.hideLoading();
        if (response.status === 200) {
            const method = response.config.method;
            const headers = response.config.headers;

            if(method == "post" && headers["X-Action"] == "create"){
                alertHelper.success("Thêm thành công");
            }
            else if(method == "put" && headers["X-Action"] == "edit"){
                alertHelper.success("Cập nhật thành công");
            }
            return response.data;
        }
        return Promise.reject(response);
    },
    (error) => {
        const store = useLoadingStore();
        store.hideLoading();
        if (error) {
            if (error.response && error.response.status === 401) {
                removeItem("token");
                window.location.reload();
                msg = error.response.data.msg;
                return;
            }
            const method = error.config.method;
            const message = error.response.data.message;
            const headers = error.config.headers;
            if(method == "post" && headers["X-Action"] == "create"){
                alertHelper.error("Thêm thất bại", message);
            }
            else if(method == "put" && headers["X-Action"] == "edit"){
                alertHelper.error("Cập nhật thất bại", message);
            }
        }
        return Promise.reject(error);
    }
);

export default instance;