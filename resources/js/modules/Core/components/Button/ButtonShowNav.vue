<template>
    <button type="button" @click="navStore.toggleActive();" class="js-navbar-vertical-aside-toggle-invoker close ml-2">
        <i :class="iconToggle"></i>
    </button>
</template>

<script setup>
import { ref, computed } from "vue";
import { useNavStore } from "~/Core/stores/navbarStore";
import { storeToRefs } from 'pinia';

const iconShow = "tio-menu_hamburger";
const iconHide = "tio-first-page";

// const iconToggle = computed(() => {
//     // toggleNav();
//     if(isMobile && isShowNav){
//         return iconShow;
//     }
//     return iconHide;
// });

const isMobile = ref(false);

const navStore = useNavStore();

const { isShowNav } = storeToRefs(navStore)

function toggleNav() {
    console.log(isMobile.value);
    const classList = document.querySelector(".navbar-vertical-aside-show-xl.has-navbar-vertical-aside").classList;
    if (window.innerWidth > 1200) {
        if (isShowNav.value) {
            classList.add("navbar-vertical-aside-mini-mode");
            return;
        }
        classList.remove("navbar-vertical-aside-mini-mode");
        return;
    }
    // mobile
    const mobileOverlay = document.querySelector("div.js-navbar-vertical-aside-toggle-invoker");
    if (isShowNav.value) {
        classList.remove("navbar-vertical-aside-closed-mode", "navbar-vertical-aside-mini-mode");
        mobileOverlay.classList.add("navbar-vertical-aside-mobile-overlay");
        return
    }
    mobileOverlay.classList.remove("navbar-vertical-aside-mobile-overlay");
    classList.remove("navbar-vertical-aside-mini-mode");
    classList.add("navbar-vertical-aside-closed-mode");
}

function handleResize() {
    const classList = document.querySelector(".navbar-vertical-aside-show-xl.has-navbar-vertical-aside").classList;
    if (window.innerWidth < 1200) {
        isMobile.value = true;
        classList.add("navbar-vertical-aside-closed-mode");
    } else {
        isMobile.value = false;
        classList.remove("navbar-vertical-aside-closed-mode");
    }
    console.log(isMobile.value);
}

window.onresize = handleResize;

window.onload = handleResize;

</script>