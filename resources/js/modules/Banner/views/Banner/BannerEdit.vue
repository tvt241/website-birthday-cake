<template>
    <PageHeaderTitleComponent header-title="Thêm quảng cáo">
        <router-link :to="{ name: 'banners' }" class="btn btn-primary text-nowrap">
            Danh sách quảng cáo
        </router-link>
    </PageHeaderTitleComponent>
    <div class="col-12">
        <form>
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="mb-0 d-flex gap-2 align-items-center">
                        <i class="tio-canvas-text"></i>
                        Thông tin quảng cáo
                    </h4>
                </div>
                <div class="card card-body h-100">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Tiêu đề
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control"
                                    :class="{ 'is-invalid': errors.title }"
                                    v-model="form.title" 
                                >
                                <span v-if="errors.title" class="invalid-feedback">
                                    {{ errors.title[0] }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Vị trí
                                    <span class="text-danger">*</span>
                                </label>
                                <select
                                    v-model="form.order"
                                    class="form-control"
                                    :class="{ 'is-invalid': errors.order }"
                                >
                                    <option v-for="(sort, index) in order" :value="index + 1">{{ index + 1 }}</option>

                                </select>
                                <span v-if="errors.order" class="invalid-feedback">
                                    {{ errors.order[0] }}
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="input-label">url</label>
                                <input type="text" class="form-control"
                                    :class="{ 'is-invalid': errors.url }"
                                    v-model="form.url" 
                                >
                                <span v-if="errors.url" class="invalid-feedback">
                                    {{ errors.url[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label">
                                    Hiển thị 
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
                                <label class="font-weight-bold text-dark">Ảnh hiển thị</label>
                                <small class="text-danger">*</small>
                                <div class="d-flex justify-content-center mt-1">
                                    <div class="upload-file">
                                        <input type="file" name="image"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                            @change="previewImage"
                                            class="upload-file__input"
                                            :class="{ 'is-invalid': errors.image }"
                                        >
                                        <div class="upload-file__img_drag upload-file__img">
                                            <img width="120" :on-error="IMG_DEFAULT" :src="states.image ? states.image : IMG_DEFAULT" alt="">
                                        </div>
                                    </div>
                                </div>
                                <span v-if="errors.image" class="invalid-feedback">
                                    {{ errors.image[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="input-label">Nội dung</label>
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
import { ref, reactive, onMounted } from "vue";
import imageHelper, { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import inputHelper from "~/Core/helpers/inputHelper";
import bannerApi from "~/Banner/apis/bannerApi";
import { useRoute } from "vue-router";

const route = useRoute();

const states = reactive({
    image: IMG_DEFAULT,
});

const errors = ref({});

const form = reactive({
    title: "",
    order: "",
    content: "",
    url: "",
    image: {},
    is_active: 1,
});

async function previewImage(event) {
    try {
        const result = await imageHelper.previewImage(event);
        states.image = result.image_src;
        form.image = result.image;
    } catch (error) {
        console.log(error);
    }
}

const order = ref(0);

async function getOrder() {
    try {
        const response = await bannerApi.getOrder();
        const data = response.data;
        order.value = form.order = data.order;
    } catch (error) {
        console.log(error);
    }
}

async function submitForm(){
    try {
        const response = await bannerApi.updateBanner(route.params.id, form);
        getOrder();
        errors.value = {};
    } catch (error) {
        const data = error.response.data;
        errors.value = data.errors;
    }
}

async function getBanner() {
    try {
        const response = await bannerApi.getBanner(route.params.id);
        const data = response.data;
        states.image = data.image;
        form.title = data.title;
        form.order = data.order;
        form.content = data.content;
        form.url = data.url;
        form.is_active = data.is_active;
        form.image = {};
    } catch (error) {
        console.log(error);
    }
}

onMounted(async () => { 
    await getOrder();
    await getBanner();
});
</script>