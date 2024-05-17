<template>
    <PageHeaderTitleComponent header-title="Danh sách thông báo">
        <router-link :to="{ name: 'posts.create' }"  class="btn btn-primary text-nowrap">
            <i class="mdi mdi-plus"></i>
            Thêm
        </router-link>
    </PageHeaderTitleComponent>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import alertHelper from "~/Core/helpers/alertHelper";
import orderApi from "~/Order/apis/orderApi";

const orders = ref({});

const filter = reactive({
    page: 1
});

async function getOrdersPaginate(page = 1) {
    filter.page = page;
    try {
        const response = await orderApi.getOrdersPaginate(filter);
        orders.value = response.data;
    } catch (error) {

    }
}

function onShowConfirm(id) {
    alertHelper.confirmDelete()
        .then((result) => {
            if (result.isConfirmed) {
                deletePost(id);
            }
        })
}

async function deleteOrder(id){
    try {
        await orderApi.deleteOrder(id);
        getOrdersPaginate();
    } catch (error) {

    }
}

onMounted(async () => { 
   await getOrdersPaginate();
});

</script>

<style>
td{
    vertical-align: middle !important;
}
</style>