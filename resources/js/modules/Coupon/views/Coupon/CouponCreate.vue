<template>
    <PageHeaderTitleComponent header-title="Thêm mã giảm giá">
        <router-link :to="{ name: 'posts' }" class="btn btn-primary text-nowrap">
            Danh sách mã giảm giá
        </router-link>
    </PageHeaderTitleComponent>
    <div class="col-12">
        <form>
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="mb-0 d-flex gap-2 align-items-center">
                        <i class="tio-canvas-text"></i>
                        Thông tin mã giảm giá
                    </h4>
                </div>
                <div class="card card-body h-100">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Tên mã giảm giá
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control"
                                    :class="{ 'is-invalid': errors.name }"
                                    v-model="form.name" 
                                >
                                <span v-if="errors.name" class="invalid-feedback">
                                    {{ errors.name[0] }}
                                </span>
                            </div>

                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Code
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                    v-model="form.code" 
                                    class="form-control"
                                    :class="{ 'is-invalid': errors.code }"
                                >
                                <span v-if="errors.code" class="invalid-feedback">
                                    {{ errors.code[0] }}
                                </span>
                            </div>

                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Kiểu giảm giá
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="discount_type" 
                                    v-model="form.discount_type"
                                    class="form-control"
                                    :class="{ 'is-invalid': errors.discount_type }"
                                >
                                    <option value="1">Tiền mặt</option>
                                   <option value="2">Phần trăm</option>
                                </select>
                                <span v-if="errors.discount_type" class="invalid-feedback">
                                    {{ errors.discount_type[0] }}
                                </span>
                            </div>

                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Giá trị mã giảm giá
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control"
                                    :class="{ 'is-invalid': errors.name }"
                                    v-model="form.name" 
                                >
                                <span v-if="errors.name" class="invalid-feedback">
                                    {{ errors.name[0] }}
                                </span>
                            </div>

                            <div class="form-group">
                                <label class="input-label">
                                    Giá trị tối đa
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" 
                                    v-model="form.discount_max"
                                    :class="{ 'is-invalid': errors.discount_max }"
                                >
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                                <span v-if="errors.discount_max" class="invalid-feedback">
                                    {{ errors.discount_max[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label">
                                    Kích hoạt
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
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="input-label">Mô tả</label>
                                <textarea class="form-control" v-model="form.desc_sort"></textarea>
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
import { ref, reactive, onMounted } from "vue";
import imageHelper, { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import inputHelper from "~/Core/helpers/inputHelper";
import postCategoryApi from "~/Post/apis/postCategoryApi";
import postApi from "~/Post/apis/postApi";

const states = reactive({
    image: IMG_DEFAULT,
});

const errors = ref({});

const form = reactive({
    name: "",
    code: "",
    discount_type: "1",
    discount_value: 0,
    discount_max: 0,
    
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
        const response = await postApi.addPost(form);
        errors.value = {};
    } catch (error) {
        const data = error.response.data;
        errors.value = data.errors;
    }
}

onMounted(async () => { 
    await getCategories();
});
</script>