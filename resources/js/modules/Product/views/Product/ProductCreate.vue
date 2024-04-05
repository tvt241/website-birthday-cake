<template>
    <LoadingComponent :active="states" />
    <PageHeaderTitleComponent :header-title="$t('label.products.create')">
        <button type="button" data-target="#modal-category" data-toggle="modal" class="btn btn-primary text-nowrap"
            @click="resetData">
            <i class="mdi mdi-plus"></i>
            {{ $t("button.create") }}
        </button>
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
                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link lang_link active" href="#" id="en-link">Việt Nam(Vi)</a>
                        </li>
                    </ul>
                    <div class="lang_form" id="en-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="input-label">Tên</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="input-label">Mô tả ngắn</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="input-label">Mô tả</label>
                                    <CkeditorBasicComponent v-model:content="form.desc" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="mb-0 d-flex gap-2 align-items-center">
                        <i class="tio-canvas-text"></i>
                        Thông tin chung
                    </h4>
                </div>
                <div class="card card-body h-100">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Slug
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Danh mục
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="category_id" class="form-control">
                                    <option>---Select---</option>
                                    <ProductCategoryOptionComponent :categories="categories" />
                                </select>
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
                                <label class="font-weight-bold text-dark">Ảnh hiển thị trang chính</label>
                                <small class="text-danger">*</small>
                                <div class="d-flex justify-content-center mt-4">
                                    <div class="upload-file">
                                        <input type="file" name="image"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                            class="upload-file__input">
                                        <div class="upload-file__img_drag upload-file__img">
                                            <img width="176" :src="imgSrcPreview" @change="previewImage($event)" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ProductInfoComponent v-if="form.is_variation === '0'" @variations-change="updateVariations">
            </ProductInfoComponent>
            <ProductVariationComponent v-if="form.is_variation === '1'" @variations-change="updateVariations">
            </ProductVariationComponent>
            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="reset" class="btn btn-secondary">{{ $t("button.reset") }}</button>
                <button type="submit" class="btn btn-primary">{{ $t("button.save") }}</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import CkeditorBasicComponent from "~/Core/components/Input/CkeditorBasicComponent.vue";
import ProductVariationComponent from "./components/ProductVariationComponent.vue";
import ProductInfoComponent from "./components/ProductInfoComponent.vue";

import { ref, reactive, onMounted } from "vue";
import { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import apiCategory from "../../apis/productCategoryApi";

const states = reactive({
    isActive: false,
})

const form = ref({
    name: "",
    desc_sort: "",
    desc_full: "",
    slug: '',
    categories: [],
    image: {},
    is_variation: "0",
    variations: []
});

function updateVariations(variations) {
    form.value.variations = variations;
}

const imgSrcPreview = ref(IMG_DEFAULT);

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

const categories = ref([]);

async function getCategories() {
    try {
        const response = await apiCategory.getCategories();
        categories.value = response.data;
    } catch (error) {

    }
}

onMounted(() => { 
    
})
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