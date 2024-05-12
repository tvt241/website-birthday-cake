import apiHelper from "~/Core/helpers/apiHelper";
import { getItem } from "~/Core/helpers/localStorageHelper";

export default {
    login: function (form){
        const url = "auth/login";
        return apiHelper.post(url, form, "login");
    },
    refresh: function(){
        const url = "auth/refresh";
        const form = {
            "refresh_token": getItem("refresh_token")
        }
        return apiHelper.post(url, form, "");
    },
    getInfo: function(){
        const url = "auth/info";
        return apiHelper.get(url, {}, "login");
    },
    updateInfo: function(form){
        const url = `auth/update`;
        return apiHelper.put(url, form);
    }
}