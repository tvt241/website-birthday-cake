<template>
    <PageHeaderTitleComponent header-title="Danh sách quảng cáo">
        <router-link :to="{ name: 'banners.create' }"  class="btn btn-primary text-nowrap">
            <i class="mdi mdi-plus"></i>
            Thêm
        </router-link>
    </PageHeaderTitleComponent>
    <div class="row g-2">
        <div class="col-12">
            <!-- Card -->
            <div class="card">
                <div class="py-4">
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th>Vị trí</th>
                                    <th>Hiển thị</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(banner, index) in banners.data">
                                    <td class="vertical-middle">{{ index + 1 }}</td>
                                    <td>
                                        <div class="media align-items-center gap-3">
                                            <div class="avatar">
                                                <img :src="banner.image ? banner.image : IMG_DEFAULT"
                                                    class="rounded img-fit">
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ banner.title }}</td>
                                    <td>{{ banner.order }}</td>
                                    <td>
                                        <div>
                                            <label class="switcher">
                                                <input class="switcher_input" type="checkbox" :checked="banner.is_active">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <router-link 
                                                class="btn btn-outline-info btn-sm edit square-btn"
                                                :to="{ name: 'banners.edit', params: { id: banner.id }}"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </router-link>
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm delete square-btn"
                                                @click="onShowConfirm(banner.id)">
                                                <i class="mdi mdi-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4 px-3">
                        <div class="d-flex justify-content-lg-end">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import alertHelper from "~/Core/helpers/alertHelper";
import bannerApi from "~/Banner/apis/bannerApi";

const banners = ref({});

const filter = reactive({
    page: 1
});

async function getBannersPaginate(page = 1) {
    filter.page = page;
    try {
        const response = await bannerApi.getBannersPaginate(filter);
        banners.value = response.data;
    } catch (error) {

    }
}

function onShowConfirm(id) {
    alertHelper.confirmDelete()
        .then((result) => {
            if (result.isConfirmed) {
                deleteBanner(id);
            }
        })
}

async function deleteBanner(id){
    try {
        await bannerApi.deleteBanner(id);
        getBannersPaginate();
    } catch (error) {

    }
}

onMounted(async () => { 
   await getBannersPaginate();
});

</script>

<style>
td{
    vertical-align: middle !important;
}
</style>