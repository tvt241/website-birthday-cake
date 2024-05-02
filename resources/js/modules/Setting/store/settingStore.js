import { defineStore } from "pinia";
import { ref } from "vue";
import settingApi from "../api/settingApi";

export const useSettingStore = defineStore("settings", () => {
    const settings = ref({
        name: "",
        phone: "",
        email: "",
        address: "",
        logo: "",
        fav_icon: "",
        latitude: 0,
        longitude: 0,
        zoom: 0
    });

    const getSettings = () => {
        return settings.value;
    }

    const setSettings = () => {
        return new Promise(async (resolve, reject) => {
            try {
                const response = await settingApi.getConfig("company");
                response.data.forEach(config => {
                    settings.value[config.key] = config.value
                });
                resolve(response);
            } catch (error) {
                reject(error.response);
            }
        });
    };
    return { getSettings, setSettings };
});
