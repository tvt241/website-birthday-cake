<script setup>
import VueElementLoading from "vue-element-loading";
import { inject } from "vue";
const active = inject('loading');
</script>

<template>
    <VueElementLoading
        spinner="bar-fade-scale"
        color="#F23E14"
        :active="active.isActive"
        :is-full-screen="true"
    >
        <!-- <img src="/static/pikachu.gif" width="55px" height="55px" /> -->
    </VueElementLoading>
</template>

