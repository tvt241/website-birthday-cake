<template>
    <PageHeaderTitleComponent header-title="Cập nhật bài viết">
        <router-link :to="{ name: 'posts' }" class="btn btn-primary text-nowrap">
            Danh sách bài viết
        </router-link>
    </PageHeaderTitleComponent>
    <div class="col-12">
        <form>
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="mb-0 d-flex gap-2 align-items-center">
                        <i class="tio-canvas-text"></i>
                        Thông tin bài viết
                    </h4>
                </div>
                <div class="card card-body h-100">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Tên bài viết
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
                                    <template v-for="category in categories">
                                        <option :value="category.id">{{ category.name }}</option>
                                    </template>
                                </select>
                                <span v-if="errors.category_id" class="invalid-feedback">
                                    {{ errors.category_id[0] }}
                                </span>
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
                                <label class="font-weight-bold text-dark">Ảnh bài viết</label>
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
import { ref, reactive, onMounted } from "vue";
import imageHelper, { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import inputHelper from "~/Core/helpers/inputHelper";
import postCategoryApi from "../../apis/postCategoryApi";
import postApi from "../../apis/postApi";
import { useRoute } from "vue-router";

const route = useRoute();

const states = reactive({
    image: IMG_DEFAULT,
});

const errors = ref({});

const form = reactive({
    name: "",
    slug: "",
    category_id: "",
    desc_sort: "",
    desc: "",
    image: {},
    is_active: 1
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

function renderSlug(event) {
    form.slug = inputHelper.renderSlug(event);
}

const categories = ref([]);

async function getCategories() {
    try {
        const response = await postCategoryApi.getCategories();
        categories.value = response.data;
    } catch (error) {
    }
}

async function submitForm(){
    try {
        const response = await postApi.updatePost(route.params.id, form);
        errors.value = {};
    } catch (error) {
        if(error.response.status == 422){
            const data = error.response.data;
            errors.value = data.errors;
        }
    }
}

async function getPost() {
    try {
        const response = await postApi.getPost(route.params.id);
        const data = response.data;
        states.image = data.image;
        form.name = data.name;
        form.slug = data.slug;
        form.category_id = data.category_id;
        form.desc_sort = data.desc_sort;
        form.desc = data.desc;
        form.is_active = data.is_active;
        form.image = {};
    } catch (error) {
        console.log(error);
    }
}

onMounted(async () => { 
    await getCategories();
    await getPost();
});
</script>