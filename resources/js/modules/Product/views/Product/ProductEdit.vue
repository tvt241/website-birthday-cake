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
                v-if="form.is_variation == 0" 
                @variations-change="updateVariations"
                :variations="variations"
                :items="items"
                :errors="errors"
            />
            <ProductVariationsComponent 
                v-if="form.is_variation == 1" 
                @variations-change="updateVariations"
                :variations="variations"
                :items="items"
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
import { useRoute } from "vue-router";

const route = useRoute();

const states = reactive({
    image: IMG_DEFAULT,
});

const errors = ref({});

const form = reactive({
    name: "",
    slug: "",
    is_active: 1,
    category_id: "",
    image: {},
    is_variation: 0,
    variations: [],
    items: [],
    desc_sort: "",
    desc: ""
});

function updateVariations(items, variations) {
    form.items = items;
    form.variations = variations;
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

const variations = reactive([]);

const items = reactive([]);

async function getProduct(id){
    try {
        const response = await productApi.getProduct(id);
        const data = response.data;
        data.variations.forEach((variation) => {
            renderVariation(variation);
        });
        form.name = data.name;
        form.slug = data.slug;
        form.desc_sort = data.desc_sort;
        form.category_id = data.category_id;
        form.is_active = data.is_active;
        form.desc = data.desc;
        states.image = data.image ? data.image.url : IMG_DEFAULT;
        if(data.variations[0].children.length) form.is_variation = 1;
        else form.is_variation = 0;
    } catch (error) {
    }
}

function renderVariation(variation, currentIndex = 0){
    if(!variations[currentIndex]){
        variations.push({
            name: "default",
            options: []
        });
    }
    variations[currentIndex].name = variation.name;
    if(!variations[currentIndex].options.includes(variation.value)){
        variations[currentIndex].options.push(variation.value);
    }
    if(variation.children.length){
        variation.children.forEach((element) => {
            renderVariation(element, currentIndex + 1);
        });
        return;
    }
    items.push({
        price_import: Number(variation.price_import),
        price: Number(variation.price),
        quantity: variation.quantity,
    });
}

async function submitForm(){
    try {
        const response = await productApi.updateProduct(route.params.id, form);
        errors.value = {};
    } catch (error) {
        const data = error.response.data;
        errors.value = data.errors;
    }
}
onMounted(async () => { 
    await getCategories();
    await getProduct(route.params.id);
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
}

.input-quantity {
    width: 100px;
}
</style>