import api_v1 from "../api/api_v1";

export default {
    get: function (url, params) {
        return api_v1.get(url, {
            params,
        });
    },
    post: function (url, body) {
        const data = JSON.stringify(body);
        return api_v1.post(url, data);
    },
    postRaw: function (url, body) {
        const headers = {
            "Content-Type": "multipart/form-data",
        };
        return api_v1.post(url, body, { headers });
    },
    put: function (url, body) {
        const data = JSON.stringify(body);
        return api_v1.put(url, data);
    },
    putRaw: function (url, body) {
        const headers = {
            "Content-Type": "multipart/form-data",
        };
        return api_v1.put(url, body, { headers });
    },
    delete: function (url) {
        return api_v1.delete(url);
    }
};
