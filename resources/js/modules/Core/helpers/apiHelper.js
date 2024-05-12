import api_v1 from "../config/api_v1";

export default {
    get: function (url, params, action) {
        const config = {
            params,
            headers: {
                "X-Action" : action
            }
        };
        return api_v1.get(url, config);
    },
    post: function (url, body, action = "create") {
        const data = JSON.stringify(body);
        const config = {
            headers: {
                "X-Action" : action
            }
        };
        return api_v1.post(url, data, config);
    },
    postRaw: function (url, body, action = "create") {
        const config = {
            headers: {
                "Content-Type": "multipart/form-data",
                "X-Action" : action
            }
        };
        return api_v1.post(url, body, config);
    },
    put: function (url, body, action = "edit") {
        const data = JSON.stringify(body);
        const config = {
            headers: {
                "X-Action" : action
            }
        };
        return api_v1.put(url, data, config);
    },
    putRaw: function (url, body, action = "edit") {
        const config = {
            headers: {
                "Content-Type": "multipart/form-data",
                "X-Action" : action
            },
            params: {
                "_method": "PUT"
            }
        };
        return api_v1.post(url, body, config);
    },
    delete: function (url, action = "delete") {
        const config = {
            headers: {
                "X-Action" : action
            }
        };
        return api_v1.delete(url, config);
    }
};
