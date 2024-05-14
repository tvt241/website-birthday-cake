import { defineStore } from "pinia";
import { ref } from "vue";

export const useGlobalStore = defineStore("globalStore", () => {
    const accept_status = ref(200);
    
    function setStatus(status){
        accept_status.value = status;
    }

    const preRouteName = ref("pos");

    function setPreRoute(status){
        preRouteName.value = status;
    }

    const isActive = ref(false);

    function showLoading() {
        isActive.value = true;
    }
    
    function hideLoading() {
        isActive.value = false;
    }

    

    return { accept_status, showLoading, hideLoading, isActive, setStatus, preRouteName, setPreRoute };
});
