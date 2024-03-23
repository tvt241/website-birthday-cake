import axios from "axios";
import toastHelper from "../helpers/toastHelper";
import { getItem } from "../composables/useLocalStorage";
import ENV from "../config/env";
import i18n from "../i18n";

const baseURL = ENV.API_URL + '/api';

const instance = axios.create({
    baseURL,
    headers: {
        "X-Locale": i18n.global.locale,
        "X-DateTime": ENV.DATE_V1,
        "Authorization": `Bearer ${getItem("token")}`
    },
    timeout: 30000,

});

instance.interceptors.response.use(
    (response) => {
        if (response.status === 200) {
            return response;
        }
        return Promise.reject(response);
    },
    (error) => {
        if (error) {
            let msg = "";
            if (error.response && error.response.status === 401) {
                msg = error.response.data.msg;
                return;
            }
            msg = "Vui lòng đăng nhập lại";
            toastHelper.error()
            Toast({
                content: msg,
                timeout: 2000,
                background: "#f44336",
            });
        } else {
            Toast({
                content: "未知错误。",
                timeout: 2000,
                background: "#f44336",
            });
        }
        return Promise.reject(error);
    }
);

export default instance;
