import { defineStore } from "pinia";
import { ref } from "vue";
import authApi from "../apis/authApi";
import { getItem, removeItem, setItem } from "~/Core/helpers/localStorageHelper";

export const useAuthStore = defineStore("authInfo", () => {
    const isLogin = ref(false);
    const authInfo = ref({});
    const menus = ref([]);
    const roles = ref([]);

    async function setToken(data){
        setItem("token", data.access_token);
        setItem("refresh_token", data.refresh_token);
        await setInfo();
        return;
    }

    function getInfo(){
        return authInfo.value;
    }

    async function setInfo(){
        try {
            if(isLogin.value){
                return authInfo.value;
            }
            const response = await authApi.getInfo();
            const data = response.data;
            authInfo.value = data.user;
            menus.value = data.menus;
            roles.value = data.roles;
            isLogin.value = true;
            return authInfo.value;
        } catch (error) {
        }
    }

    async function refreshToken(){
        try {
            const response = await authApi.refresh();
            const data = response.data;
            setToken(data);
        } catch (error) {
            removeItem("token");
            isLogin.value = false;
        }
    }

    function getMenus(){
        return menus.value;
    }

    function getRoles(){
        return roles.value;
    }

    return { isLogin, getInfo, setInfo, getMenus, getRoles, setToken, refreshToken };
});


