<template>
    <LoadingComponent :active="loading" />
    <PageHeaderTitleComponent :header-title="$t('menu.products.categories')">
        <button type="button" data-target="#modal-category" data-toggle="modal" class="btn btn-primary text-nowrap" @click="resetData">
            <i class="mdi mdi-plus"></i>
            {{ $t("button.create") }}
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
                                    <th class="border-top-0" style="width: 30%">{{ $t("label.name") }}</th>
                                    <th class="border-top-0" style="width: 30%">{{ $t("label.slug") }}</th>
                                    <th class="border-top-0" style="width: 15%">{{ $t("label.status") }}</th>
                                    <th class="border-top-0" style="width: 15%">{{ $t("label.action") }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <ProductCategoryChildComponent 
                                    :categories="categories.data"
                                    @show-confirm="onShowConfirm" 
                                    @show-edit="getCategory"
                                />
                            </tbody>
                        </table>
                        <Bootstrap4Pagination :data="categories" @pagination-change-page="getCategories">
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
                    <h5 class="modal-title" id="modal-category-title">{{ modelContent[modelType.action].title }}</h5>
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
                            <label for="category-desc">
                                Danh mục cha
                                <small class="text-danger">*</small>
                            </label>
                            <select class="form-control" v-model="form.category_id" id="category-desc">
                                <option value="null">-- Danh mục cha --</option>
                                <ProductCategoryOptionComponent :categories="categories.data" />
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category-slug">
                                Slug
                                <small class="text-danger">*</small>
                            </label>
                            <input type="" class="form-control" v-model="form.slug" id="category-slug">
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <img width="105" class="rounded-10 border" id="viewer" :src="imgSrcPreview" alt="image">
                            </div>
                            <label>Ảnh</label>
                            <div class="custom-file">
                                <input type="file" name="image" @change="previewImage($event)" id="category-image"
                                    class="custom-file-input"
                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                <label class="custom-file-label" for="category-image">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category-desc">Mô tả</label>
                            <input type="" class="form-control" v-model="form.description" id="category-desc">
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" @click="resetData" class="btn btn-warning btn-reset">
                        {{ $t("button.reset") }}
                    </button>
                    <div class="gap-2 d-flex">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ $t("button.close") }}
                        </button>
                        <button type="button" class="btn btn-primary" @click="handleModelAction">
                            {{ $t("button." + modelContent[modelType.action].button) }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import LoadingComponent from "~/Core/components/LoadingComponent.vue";
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import ProductCategoryChildComponent from './components/ProductCategoryChildComponent.vue';
import ProductCategoryFilterComponent from './components/ProductCategoryFilterComponent.vue';
import ProductCategoryOptionComponent from './components/ProductCategoryOptionComponent.vue';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import alertHelper from "~/Core/helpers/alertHelper";

import { ref, reactive, onMounted } from "vue";
import { IMG_DEFAULT } from "~/Core/config/env";
import apiHelper from "~/Core/helpers/apiHelper";

const imgSrcPreview = ref(IMG_DEFAULT);

const modelType = reactive({
    action: "add",
    id: ""
});

const modelContent = {
    add: {
        title: "Thêm danh mục sản phẩm",
        button: "save"
    },
    edit: {
        title: "Chỉnh sửa danh mục sản phẩm",
        button: "update"
    },

};

const loading = reactive({
    isActive: false
});

const categories = ref({});

const formDataDefault = {
    name: "",
    category_id: "",
    slug: "",
    image: {},
    description: "",
};

const form = ref(formDataDefault);

const filter = reactive({
    page: 1,
    "is-active": null,
    depth: null
});

function resetData() {
    console.log(formDataDefault);
    form.value = { ...formDataDefault };
    states.image = IMG_DEFAULT;
    modelType.action = "add";
}

function previewImage(event) {
    if (event.target.files && event.target.files[0]) {
        form.image = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            imgSrcPreview.value = e.target.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
}

function renderSlug() {
    const nameFormat = form.name.toLowerCase().replaceAll(" ", "-");
    form.slug = removeAccents(nameFormat);
    console.log(form.slug);
}

function removeAccents(str) {
    var AccentsMap = [
        "aàảãáạăằẳẵắặâầẩẫấậ",
        "AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
        "dđ", "DĐ",
        "eèẻẽéẹêềểễếệ",
        "EÈẺẼÉẸÊỀỂỄẾỆ",
        "iìỉĩíị",
        "IÌỈĨÍỊ",
        "oòỏõóọôồổỗốộơờởỡớợ",
        "OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
        "uùủũúụưừửữứự",
        "UÙỦŨÚỤƯỪỬỮỨỰ",
        "yỳỷỹýỵ",
        "YỲỶỸÝỴ"
    ];
    for (var i = 0; i < AccentsMap.length; i++) {
        var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
        var char = AccentsMap[i][0];
        str = str.replace(re, char);
    }
    return str;
}

async function getCategories(page = 1) {
    filter.page = page;
    try {
        const response = await apiHelper.get("categories", filter);
        categories.value = response.data;
    } catch (error) {
    }
    loading.isActive = false;
}

async function getCategory(id) {
    modelType.id = id;
    modelType.action = "edit";
    try {
        const response = await apiHelper.get(`categories/${modelType.id}`);
        if(response.data.image.url){
            imgSrcPreview.value = response.data.image.url;
        }
        form.value = response.data;
    } catch (error) {
    }
    loading.isActive = false;
}

async function handleModelAction() {
    try {
        if (modelType.action == "add") {
            await addCategory();
        } else {
            await updateCategory();
        }
        getCategories();
    } catch (error) {
    }
}

function addCategory(){
    return apiHelper.postRaw("categories", form);
}

function updateCategory(){
    return apiHelper.putRaw(`categories/${modelType.id}`, form);
}

async function deleteCategory() {
    try {
        const response = await apiHelper.delete("categories");
        categories.value = response.data;
    } catch (error) {
    }
    loading.isActive = false;
}

function onShowConfirm(id) {
    alertHelper.confirmDelete()
        .then((result) => {
            console.log("abc gi do");
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            }
        })
}

onMounted(async () => {
    loading.isActive = true;
    await getCategories();
});
</script>
