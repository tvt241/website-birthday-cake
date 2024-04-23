<template>
    <PageHeaderTitleComponent header-title="Thêm sản phẩm">
        <router-link :to="{ name: 'products' }" class="btn btn-primary text-nowrap">
            Danh sách sản phẩm
        </router-link>
    </PageHeaderTitleComponent>
    <div class="col-12">
        <form>
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="mb-0 d-flex gap-2 align-items-center">
                        <i class="tio-canvas-text"></i>
                        Thông tin sản phẩm
                    </h4>
                </div>
                <div class="card card-body h-100">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Tên sản phẩm
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control"
                                    :class="{ 'is-invalid': errors.name }"
                                    v-model="form.name" 
                                    @keyup="renderSlug"
                                >
                                <span v-if="errors.name" class="invalid-feedback">
                                    {{ errors.name[0] }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Slug
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                    v-model="form.slug" 
                                    class="form-control"
                                    :class="{ 'is-invalid': errors.slug }"
                                >
                                <span v-if="errors.slug" class="invalid-feedback">
                                    {{ errors.slug[0] }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Danh mục
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="category_id" 
                                    v-model="form.category_id"
                                    class="form-control"
                                    :class="{ 'is-invalid': errors.category_id }"
                                >
                                    <option value="">---Chọn danh mục---</option>
                                    <ProductCategoryOptionComponent :categories="categories" />
                                </select>
                                <span v-if="errors.category_id" class="invalid-feedback">
                                    {{ errors.category_id[0] }}
                                </span>
                            </div>
                            
                            <div class="form-group">
                                <label class="input-label">
                                    Phân loại
                                    <span class="text-danger">*</span>
                                </label>
                                <select v-model="form.is_variation" class="form-control">
                                    <option value="0">Không phân loại</option>
                                    <option value="1">Phân loại</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label">
                                    Hiển thị trang nguời dùng
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" 
                                    v-model="form.is_active"
                                    :class="{ 'is-invalid': errors.is_active }"
                                >
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                                <span v-if="errors.is_active" class="invalid-feedback">
                                    {{ errors.is_active[0] }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Ảnh sản phẩm</label>
                                <small class="text-danger">*</small>
                                <div class="d-flex justify-content-center mt-4">
                                    <div class="upload-file">
                                        <input type="file" name="image"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                            @change="previewImage"
                                            class="upload-file__input"
                                            :class="{ 'is-invalid': errors.image }"
                                        >
                                        <div class="upload-file__img_drag upload-file__img">
                                            <img width="200" :src="states.image" alt="">
                                        </div>
                                    </div>
                                </div>
                                <span v-if="errors.image" class="invalid-feedback">
                                    {{ errors.image[0] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ProductVariationComponent 
                v-if="form.is_variation === '0'" 
                @variations-change="updateVariations"
                :errors="errors"
            />
            <ProductVariationsComponent 
                v-if="form.is_variation === '1'" 
                @variations-change="updateVariations"
                :errors="errors"
            />
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="mb-0 d-flex gap-2 align-items-center">
                        <i class="tio-canvas-text"></i>
                        Mô tả sản phẩm
                    </h4>
                </div>
                <div class="card card-body h-100">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="input-label">Mô tả ngắn</label>
                                <textarea class="form-control" v-model="form.desc_sort"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="input-label">Mô tả</label>
                                <CkeditorBasicComponent v-model:content="form.desc" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="reset" class="btn btn-secondary">Đặt lại</button>
                <button type="button" class="btn btn-primary" @click="submitForm">Lưu</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import CkeditorBasicComponent from "~/Core/components/Input/CkeditorBasicComponent.vue";
import ProductVariationsComponent from "~/Product/views/Product/components/ProductVariationsComponent.vue";
import ProductVariationComponent from "~/Product/views/Product/components/ProductVariationComponent.vue";
import ProductCategoryOptionComponent from '~/Product/views/Category/components/ProductCategoryOptionComponent.vue';

import { ref, reactive, onMounted } from "vue";
import imageHelper, { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import inputHelper from "~/Core/helpers/inputHelper";
import categoryApi from "../../apis/productCategoryApi";
import productApi from "../../apis/productApi";

const states = reactive({
    image: IMG_DEFAULT,
});

const errors = ref({});

const variations = [{
    name: "default",
    options: [
        "default"
    ]
}];

const items = [{
    price_import: 0,
    price: 0,
    quantity: 0,
}];
const formDataDefault = {
    name: "",
    slug: "",
    is_active: 1,
    category_id: "",
    image: {},
    is_variation: "0",
    variations: variations,
    items: items,
    desc_sort: "",
    desc: ""
}

const form = reactive(formDataDefault);

function updateVariations(items, variations) {
    form.items = items;
    form.variations = variations;
}

function resetData() {
    Object.assign(form, formDataDefault);
    states.image = IMG_DEFAULT;
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

const categories = ref([]);

async function getCategories() {
    try {
        const response = await categoryApi.getCategories();
        categories.value = response.data;
    } catch (error) {

    }
}

async function submitForm(){
    try {
        const response = await productApi.addProduct(form);
        errors.value = {};
    } catch (error) {
        const data = error.response.data;
        errors.value = data.errors;
    }
}

onMounted(() => { 
    getCategories();
});
</script>

<style scoped>
.handle {
    float: left;
    padding-top: 8px;
    padding-bottom: 8px;
}

.close {
    float: right;
    padding-top: 8px;
    padding-bottom: 8px;
}

.input-variation {
    display: inline-block;
    /* width: 50%; */
}

.input-quantity {
    width: 100px;
}
</style>

<!-- <div class="form-group">
    <div class="input-label justify-content-between">
        <label for="">Đơn vị tính</label>
        <button class="btn btn-sm square-btn btn-primary">
            <i class="mdi mdi-plus"></i>
        </button>
    </div>
    <div class="form-inline mt-1 justify-content-between">
        <label for="" class="col-6 pl-0 justify-content-start">Tên : Số lượng quy đổi</label>
        <input type="text" class="form-control col-2 p-1">
        :
        <input type="text" class="form-control col-2 p-1">
        <button class="btn btn-sm square-btn btn-info text-white">
            <i class="mdi mdi-minus"></i>
        </button>
    </div>
</div> -->