import apiHelper from "~/Core/helpers/apiHelper";

export default {
    getConfig: function (group, key = null){
        const data = {
            group,
            key
        }
        const url = "get-config";
        return apiHelper.post(url, data, "");
    },
    setConfig: function(group, form){
        const url = `update-config/${group}`;
        return apiHelper.postRaw(url, form, "");
    },
    getService: function (service){
        const data = {
            service
        }
        const url = "get-service";
        return apiHelper.post(url, data, "");
    },
}