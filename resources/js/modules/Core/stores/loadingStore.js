import { defineStore } from "pinia";
import { ref } from "vue";

export const useLoadingStore = defineStore("loadingStore", () => {
    const isActive = ref(false);

    function showLoading() {
        isActive.value = true;
    }
    
    function hideLoading() {
        isActive.value = false;
    }

    return { showLoading, hideLoading, isActive };
});
