<template>
    <PageHeaderTitleComponent header-title="Danh sách bài viết">
        <router-link :to="{ name: 'posts.create' }"  class="btn btn-primary text-nowrap">
            <i class="mdi mdi-plus"></i>
            Thêm
        </router-link>
    </PageHeaderTitleComponent>
    <div class="row g-2">
        <div class="col-12">
            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <!-- <div class="card-top px-card pt-4">
                    <div class="row justify-content-between align-items-center gy-2">
                        <div class="col-lg-4">
                            <form action="http://localhost:2222/admin/product/list" method="GET">
                                <div class="input-group">
                                    <input id="" type="search" name="search" class="form-control"
                                        placeholder="Search by product name" aria-label="Search" value="" required
                                        autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> -->

                <div class="py-4">
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Tên bài viết</th>
                                    <th>Danh mục</th>
                                    <th>Mô tả ngắn</th>
                                    <th>Hiển thị</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(post, index) in posts.data">
                                    <td class="vertical-middle">{{ index + 1 }}</td>
                                    <td>
                                        <div class="media align-items-center gap-3">
                                            <div class="avatar">
                                                <img :src="post.image ? post.image : IMG_DEFAULT"
                                                    class="rounded img-fit">
                                            </div>

                                            <div class="media-body">
                                                <a class="text-dark" href="#">
                                                    {{ post.name }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ post.category_name }}</td>
                                    <td>{{ post.desc_sort }}</td>
                                    <td>
                                        <div>
                                            <label class="switcher">
                                                <input class="switcher_input" type="checkbox" :checked="post.is_active">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <router-link 
                                                class="btn btn-outline-info btn-sm edit square-btn"
                                                :to="{ name: 'posts.edit', params: { id: post.id }}"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </router-link>
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm delete square-btn"
                                                @click="onShowConfirm(post.id)">
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
import postApi from "~/Post/apis/postApi";

const posts = ref({});

const filter = reactive({
    page: 1
});

async function getPostsPaginate(page = 1) {
    filter.page = page;
    try {
        const response = await postApi.getPostsPaginate(filter);
        posts.value = response.data;
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

async function deletePost(id){
    try {
        await postApi.deletePost(id);
        getPostsPaginate();
    } catch (error) {

    }
}

onMounted(async () => { 
   await getPostsPaginate();
});

</script>

<style>
td{
    vertical-align: middle !important;
}
</style>