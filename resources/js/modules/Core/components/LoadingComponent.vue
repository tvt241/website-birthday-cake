<script setup>
import VueElementLoading from "vue-element-loading";
const props = defineProps(['props']);
</script>

<template>
    <VueElementLoading
        spinner="bar-fade-scale"
        color="#F23E14"
        :active="props.isActive"
        :is-full-screen="true"
    >
        <!-- <img src="/static/pikachu.gif" width="55px" height="55px" /> -->
    </VueElementLoading>
</template>

