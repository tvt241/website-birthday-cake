<template>
    <div class=" d-flex flex-wrap mb-4 gap-2 justify-content-between">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2 text-capitalize ">
            <span class="page-header-title">
                {{ props.headerTitle ?? "" }}
            </span>
        </h2>
        <slot></slot>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps(["headerTitle"])

</script>