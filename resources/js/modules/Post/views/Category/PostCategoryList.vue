<template>
    <PageHeaderTitleComponent header-title="Danh sách danh mục bài viết">
        <button type="button" data-target="#modal-category" data-toggle="modal" class="btn btn-primary text-nowrap" @click="resetData">
            <i class="mdi mdi-plus"></i>
            Thêm
        </button>
    </PageHeaderTitleComponent>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <ProductCategoryFilterComponent/> -->
                <div class="py-3">
                    <div class="table-responsive">
                        <table
                            class="table table-borderless table-hover table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0" style="width: 30%">Tên</th>
                                    <th class="border-top-0" style="width: 30%">Slug</th>
                                    <th class="border-top-0" style="width: 15%">Trạng thái</th>
                                    <th class="border-top-0" style="width: 15%">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(category, index) in categories.data">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ category.name }}</td>
                                    <td>{{ category.slug }}</td>
                                    <td>
                                        <label class="switcher">
                                        <input type="checkbox" @click="changeActive(category.id)" class="switcher_input" :checked="category.is_active">
                                        <span class="switcher_control"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center gap-2">
                                        <button class="btn btn-sm btn-outline-info square-btn" type="button" data-target="#modal-category"
                                            data-toggle="modal" @click="getCategory(category.id)">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger square-btn" @click="onShowConfirm(category.id)">
                                            <i class="mdi mdi-trash-can"></i>
                                        </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <Bootstrap4Pagination :data="categories" @pagination-change-page="getCategoriesPaginate">
                        </Bootstrap4Pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-category" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-category-title">{{ modelContent[states.action].title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="category-name">
                                Tên danh mục
                                <small class="text-danger">*</small>
                            </label>
                            <input type="text" class="form-control" @keyup="renderSlug" v-model="form.name"
                                id="category-name">
                        </div>
                        <div class="form-group">
                            <label for="category-slug">
                                Slug
                                <small class="text-danger">*</small>
                            </label>
                            <input type="" class="form-control" v-model="form.slug" id="category-slug">
                        </div>
                        <div class="form-group">
                            <label for="category-desc">Mô tả</label>
                            <input type="" class="form-control" v-model="form.description" id="category-desc">
                        </div>
                    </form>
                </div>
                <div class="modal-footer gap-2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Đóng
                        </button>
                        <button type="button" class="btn btn-primary" @click="handleModelAction">
                            {{ modelContent[states.action].button }}
                        </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import alertHelper from "~/Core/helpers/alertHelper";

import { ref, reactive, onMounted } from "vue";
import postCategoryApi from "~/Post/apis/postCategoryApi";
import inputHelper from "~/Core/helpers/inputHelper";


const states = reactive({
    id: "",
    action: "add",
});

const modelContent = {
    add: {
        title: "Thêm danh mục tin tức",
        button: "Lưu"
    },
    edit: {
        title: "Chỉnh sửa danh mục tin tức",
        button: "Cập nhật"
    },

};

const categories = ref({});

const form = reactive({
    name: "",
    slug: "",
    description: "",
    is_active: 1,
});

const filter = reactive({
    page: 1,
});

function resetData() {
    form.name = "";
    form.slug = "";
    form.description = "";
    form.is_active = 1;
    states.action = "add";
}


async function getCategoriesPaginate(page = 1) {
    filter.page = page;
    try {
        const response = await postCategoryApi.getCategoriesPaginate(filter);
        categories.value = response.data;
    } catch (error) {
    }
}

async function getCategory(id) {
    states.id = id;
    states.action = "edit";
    try {
        const response = await postCategoryApi.getCategory(states.id);
        const data = response.data;
        form.name = data.name;
        form.slug = data.slug;
        form.description = data.description;
        form.is_active = data.is_active;
    } catch (error) {
    }
}

async function handleModelAction() {
    try {
        if (states.action == "add") {
            await postCategoryApi.addCategory(form);
        } else {
            await postCategoryApi.updateCategory(states.id, form);
        }
        getCategoriesPaginate();
    } catch (error) {
    }
}

async function deleteCategory(id) {
    try {
        const response = await postCategoryApi.deleteCategory(id);
        getCategoriesPaginate();
    } catch (error) {
    }
}

function onShowConfirm(id) {
    alertHelper.confirmDelete()
        .then((result) => {
            if (result.isConfirmed) {
                deleteCategory(id);
            }
        })
}

function renderSlug(event) {
    form.slug = inputHelper.renderSlug(event);
}

async function changeActive(id) {
    try {
        const response = await postCategoryApi.changeActiveCategory(id);
        getCategoriesPaginate();
    } catch (error) {
    }
}


onMounted(async () => {
    await getCategoriesPaginate();
});
</script>
