<template>
    <PageHeaderTitleComponent header-title="Danh sách danh mục sản phẩm">
        <button type="button" data-target="#modal-category" data-toggle="modal" class="btn btn-primary text-nowrap"
            @click="resetData">
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
                                <ProductCategoryChildComponent :categories="categoriesPaginate.data"
                                    @show-confirm="onShowConfirm" 
                                    @show-edit="getCategory"
                                    @handle-toggle-child="handleToggleChild" 
                                    @change-active="onUpdateActive"
                                />
                            </tbody>
                        </table>
                        <Bootstrap4Pagination :data="categoriesPaginate"
                            @pagination-change-page="getCategoriesPaginate">
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
                            <label for="category-desc">
                                Danh mục cha
                                <small class="text-danger">*</small>
                            </label>
                            <select class="form-control" v-model="form.category_id" id="category-desc">
                                <option value="">-- Danh mục cha --</option>
                                <ProductCategoryOptionComponent :categories="categories" />
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
                            <label for="category-desc">
                                Hiển thị
                            </label>
                            <select class="form-control" v-model="form.is_active" id="category-desc">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <img width="105" class="rounded-10 border" id="viewer" :on-error="IMG_DEFAULT" :src="states.image" alt="image">
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
                <div class="modal-footer gap-2">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Đóng
                        </button>
                        <button type="button" class="btn btn-primary" @click="handleModelAction">
                            {{  modelContent[states.action].button }}
                        </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import ProductCategoryChildComponent from './components/ProductCategoryChildComponent.vue';
import ProductCategoryOptionComponent from './components/ProductCategoryOptionComponent.vue';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import alertHelper from "~/Core/helpers/alertHelper";

import { ref, reactive, onMounted } from "vue";
import imageHelper, { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import categoryApi from "../../apis/productCategoryApi";
import inputHelper from "~/Core/helpers/inputHelper";

// config
const states = reactive({
    image: "",
    id: "",
    action: "add"
});

const modelContent = {
    add: {
        title: "Thêm danh mục sản phẩm",
        button: "Lưu"
    },
    edit: {
        title: "Chỉnh sửa danh mục sản phẩm",
        button: "Cập nhật"
    },

};

const filter = reactive({
    page: 1,
    "is-active": null,
    depth: null
});
//option
const categories = ref([]);

async function getCategories() {
    try {
        const response = await categoryApi.getCategories();
        categories.value = response.data;
    } catch (error) {
    }
}
// list
const categoriesPaginate = ref({});

async function getCategoriesPaginate(page = 1) {
    filter.page = page;
    try {
        const response = await categoryApi.getCategoriesPaginate(filter);
        categoriesPaginate.value = response.data;
    } catch (error) {
    }
}
// get
async function getCategory(id) {
    states.id = id;
    states.action = "edit";
    try {
        const response = await categoryApi.getCategory(id);
        states.image = response.data.image;
        const data = response.data;
        form.name = data.name;
        form.slug = data.slug;
        form.category_id = data.category_id ? data.category_id : "";
        form.description = data.description;
        form.image = {};
    } catch (error) {
    }
}
// create
const form = reactive({
    name: "",
    category_id: "",
    slug: "",
    image: {},
    description: "",
    is_active: "1"
});

async function handleModelAction() {
    try {
        if (states.action == "add") {
            await categoryApi.addCategory(form);
        } else {
            await categoryApi.updateCategory(states.id, form);
        }
        getCategoriesPaginate();
    } catch (error) {
    }
}
// delete
async function deleteCategory(id) {
    try {
        await categoryApi.deleteCategory(id);
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


async function onUpdateActive(id) {
    try {
        await categoryApi.changeActiveCategory(id);
        getCategoriesPaginate();
    } catch (error) {
    }
}


function resetData() {
    form.name = "";
    form.category_id = "";
    form.image = {};
    form.slug = "";
    form.description = "";
    states.image = IMG_DEFAULT;
    states.action = "add";
}

async function previewImage(event) {
    try {
        const result = await imageHelper.previewImage(event);
        states.image = result.image_src;
        form.image = result.image;
    } catch (error) {
        console.log(error);
    }
}

function renderSlug(event) {
    form.slug = inputHelper.renderSlug(event);
}

function handleToggleChild(event, id) {
    const classList = event.target.classList;
    if (classList.contains("mdi-chevron-right")) {
        classList.remove("mdi-chevron-right");
        classList.add("mdi-chevron-down");
        toggleChild(id, false);
    }
    else {
        classList.remove("mdi-chevron-down");
        classList.add("mdi-chevron-right");
        toggleChild(id, true);
    }
}

function toggleChild(id, isShow) {
    const listChild = document.querySelectorAll(`tr[data-parent-id='${id}'`);
    if (!listChild.length) {
        return;
    }
    if (isShow) {
        listChild.forEach((tagTr) => {
            tagTr.classList.add("d-none");
            let idParent = tagTr.getAttribute("data-id");
            toggleChild(idParent, isShow);
        });
        return;
    }
    listChild.forEach((tagTr) => {
        tagTr.classList.remove("d-none");
    });
}


onMounted(async () => {
    await getCategoriesPaginate();
    await getCategories();
});
</script>
