<script setup>
import VueElementLoading from "vue-element-loading";
import { useGlobalStore } from "~/Core/stores/globalStore";

const store = useGlobalStore();
</script>

<template>
    <VueElementLoading
        spinner="bar-fade-scale"
        color="#F23E14"
        :active="store.isActive"
        :is-full-screen="true"
    >
        <!-- <img src="/static/pikachu.gif" width="55px" height="55px" /> -->
    </VueElementLoading>
</template>

