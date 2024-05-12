<template>
    <div class="container-full-width">
        <div class="for-margin">
            <div class="for-image text-center">
                <img style="max-height: 300px" :src="IMG_FOLDER + '/403.webp'" alt="">
            </div>
            <h2 class="page-not-found">Bạn không có quyền truy cập trang này</h2>

            <div style="text-align: center;">
                <router-link :to="globalStore.preRouteName" class="btn btn-primary mt-2">
                    Quay lại
                </router-link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useGlobalStore } from "~/Core/stores/globalStore";
import { IMG_FOLDER } from "../helpers/imageHelper";

const globalStore = useGlobalStore();
</script>

<style scoped>

    .container-full-width{
        display: flex;
        justify-content: center;
        width: 100%;
        height: 100vh;
        align-items: center;
    }
    .for-margin {

    }

    .page-not-found {
        margin-top: 30px;
        font-weight: 600;
        text-align: center;
    }
</style>