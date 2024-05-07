<template>
    <PageHeaderTitleComponent header-title="Thêm khách hàng">
        <router-link :to="{ name: 'posts' }" class="btn btn-primary text-nowrap">
            Danh sách khách hàng
        </router-link>
    </PageHeaderTitleComponent>
    <div class="col-12">
        <form>
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="mb-0 d-flex gap-2 align-items-center">
                        <i class="tio-canvas-text"></i>
                        Thông tin khách hàng
                    </h4>
                </div>
                <div class="card card-body h-100">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Số điện thoại
                                </label>
                                <input type="text" class="form-control"
                                    :class="{ 'is-invalid': errors.phone }"
                                    v-model="form.phone" 
                                >
                                <span v-if="errors.phone" class="invalid-feedback">
                                    {{ errors.phone[0] }}
                                </span>
                            </div>

                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Email
                                </label>
                                <input type="text" class="form-control"
                                    :class="{ 'is-invalid': errors.email }"
                                    v-model="form.email" 
                                >
                                <span v-if="errors.email" class="invalid-feedback">
                                    {{ errors.email[0] }}
                                </span>
                            </div>


                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Tên đăng nhập
                                </label>
                                <input type="text" class="form-control"
                                    :class="{ 'is-invalid': errors.username }"
                                    v-model="form.username" 
                                >
                                <span v-if="errors.username" class="invalid-feedback">
                                    {{ errors.username[0] }}
                                </span>
                            </div>

                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Mật khẩu
                                </label>
                                <input type="text" class="form-control"
                                    :class="{ 'is-invalid': errors.password }"
                                    v-model="form.password" 
                                    placeholder="Mặc định: 12345678"
                                >
                                <span v-if="errors.password" class="invalid-feedback">
                                    {{ errors.password[0] }}
                                </span>
                            </div>

                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Tên khách hàng
                                </label>
                                <input type="text" class="form-control"
                                    :class="{ 'is-invalid': errors.name }"
                                    v-model="form.name" 
                                >
                                <span v-if="errors.name" class="invalid-feedback">
                                    {{ errors.name[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Giới tính
                                </label>
                                <select class="form-control" 
                                    v-model="form.gender"
                                    :class="{ 'is-invalid': errors.gender }"
                                >
                                    <option value="2">Khác</option>
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Nữ</option>
                                </select>
                                <span v-if="errors.gender" class="invalid-feedback">
                                    {{ errors.gender[0] }}
                                </span>
                            </div>

                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Ngày sinh
                                </label>
                                <input type="date" class="form-control"
                                    :class="{ 'is-invalid': errors.birthday }"
                                    v-model="form.birthday" 
                                >
                                <span v-if="errors.birthday" class="invalid-feedback">
                                    {{ errors.birthday[0] }}
                                </span>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Ảnh đại diện</label>
                                <div class="d-flex justify-content-center mt-1">
                                    <div class="upload-file">
                                        <input type="file" name="image"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                            @change="previewImage"
                                            class="upload-file__input"
                                            :class="{ 'is-invalid': errors.image }"
                                        >
                                        <div class="upload-file__img_drag upload-file__img">
                                            <img width="125" :src="states.image" alt="">
                                        </div>
                                    </div>
                                </div>
                                <span v-if="errors.image" class="invalid-feedback">
                                    {{ errors.image[0] }}
                                </span>
                            </div>

                            <div class="form-group">
                                <label class="input-label">
                                    Kích hoạt
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" 
                                    v-model="form.is_active"
                                    :class="{ 'is-invalid': errors.is_active }"
                                >
                                    <option value="1">Kích hoạt</option>
                                    <option value="0">Không kích hoạt</option>
                                </select>
                                <span v-if="errors.is_active" class="invalid-feedback">
                                    {{ errors.is_active[0] }}
                                </span>
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
import imageHelper, { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import customerApi from "~/Customer/apis/customerApi";
import { reactive, ref, onMounted } from "vue";

const states = reactive({
    image: IMG_DEFAULT,
});

const errors = ref({});

const form = reactive({
    phone: "",
    email: "",
    username: "",
    password: "",
    name: "",
    gender: "",
    birthday: "",
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

async function submitForm(){
    try {
        const response = await customerApi.addCustomer(form);
        errors.value = {};
    } catch (error) {
        const data = error.response.data;
        errors.value = data.errors;
    }
}

onMounted(() => { 
});
</script>