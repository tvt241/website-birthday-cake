import { defineStore } from "pinia";
import { ref } from "vue";

export const useAuthStore = defineStore("authInfo", () => {
    const authToken = ref(null);
    const authRefreshToken = ref(null);
    const authInfo = ref(null);

    const requestLogin = (form) => {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await axios.post("login", form);
                authToken.value = response.data.access_token;
                authRefreshToken.value = response.data.refresh_token;
                resolve(response);
            } catch (error) {
                reject(error.response);
            }
        });
    };
    return { authToken, authInfo, authRefreshToken, requestLogin };
});
