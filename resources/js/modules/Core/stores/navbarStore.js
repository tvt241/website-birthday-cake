import { defineStore } from "pinia";
import { ref } from "vue";

export const useNavStore = defineStore("navBarActive", () => {
    const isShowNav = ref(false);

    function toggleActive() {
        isShowNav.value = !isShowNav.value;
    }
    
    function hiddenNav() {
        isShowNav.value = false;
    }

    return { isShowNav, toggleActive, hiddenNav };
});
