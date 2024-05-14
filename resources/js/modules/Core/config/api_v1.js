import axios from "axios";
import { getItem, removeItem } from "../helpers/localStorageHelper";
import ENV from "./env";
import i18n from "../i18n";
import alertHelper from "../helpers/alertHelper";
import { useGlobalStore } from "../stores/globalStore";


const instance = axios.create({
    baseURL: "/api/",
    headers: {
        // "X-Locale": i18n.global.locale,
        "X-Locale": "vi",
        "Content-Type": "application/json",
        "X-DateTime": ENV.DATE_V1,
    },
    timeout: 3000,
});

instance.interceptors.request.use((config) => {
    const store = useGlobalStore();
    store.showLoading();
    config.headers.Authorization =  "Bearer " + getItem("token");
    return config;
});

instance.interceptors.response.use(
    (response) => {
        const store = useGlobalStore();
        store.hideLoading();
        if (response.status === 200) {
            const headers = response.config.headers;

            if(headers["X-Action"] == "create"){
                alertHelper.success("Thêm thành công");
            }
            else if(headers["X-Action"] == "edit"){
                alertHelper.success("Cập nhật thành công");
            }
            else if(headers["X-Action"] == "delete"){
                alertHelper.success("Xóa thành công");
            }
            return response.data;
        }
        return Promise.reject(response);
    },
    (error) => {
        const store = useGlobalStore();
        store.hideLoading();
        if (error) {
            const headers = error.config.headers;
            if (error.response) {
                if(error.response.status === 401 && headers["X-Action"] != "login"){
                    removeItem("token");
                    console.log("vaof aday ?");
                    debugger;
                    window.location.reload();
                    msg = error.response.data.msg;
                    return;
                }
                else if(error.response.status === 404){
                    store.setStatus(404);
                }
                else if(error.response.status === 403){
                    store.setStatus(403);
                }
            }
            const message = error.response.data.message;
            if(headers["X-Action"] == "create"){
                alertHelper.error("Thêm thất bại", message);
            }
            else if(headers["X-Action"] == "edit"){
                alertHelper.error("Cập nhật thất bại", message);
            }
            else if(headers["X-Action"] == "delete"){
                alertHelper.error("Xóa thất bại", message);
            }
        }
        return Promise.reject(error);
    }
);

export default instance;