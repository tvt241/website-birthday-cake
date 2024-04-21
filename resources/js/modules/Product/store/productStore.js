import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useAuthStore = defineStore("authInfo", () => {
    const authToken = ref("");
    const authInfo = ref(null);

    const requestLogin = (form) => {
        return new Promise((resolve, reject) => {
            axios.post("auth/login", form)
            .then((res) => {
                // authToken = res.data.access_token;
                // setLocalStorage("authToken", authToken);
                // setLocalStorage("authRefreshToken", res.data.refresh_token);
                // resolve(res);
            }).catch((err) => {
                reject(err.response);

            })
        })
    };

    return { authToken, authInfo, authRefreshToken, requestLogin };
});
