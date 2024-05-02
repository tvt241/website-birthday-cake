<template>
    <PageHeaderTitleComponent header-title="Cập nhật nhân viên">
        <router-link :to="{ name: 'employees' }" class="btn btn-primary text-nowrap">
            Danh sách nhân viên
        </router-link>
    </PageHeaderTitleComponent>
    <div class="col-12">
        <form>
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="mb-0 d-flex gap-2 align-items-center">
                        <i class="tio-canvas-text"></i>
                        Thông tin nhân viên
                    </h4>
                </div>
                <div class="card card-body h-100">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Tên
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
                                    Email
                                    <span class="text-danger">*</span>
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
                                    Mật khẩu
                                </label>
                                <input type="text" class="form-control"
                                    :class="{ 'is-invalid': errors.password }"
                                    v-model="form.password" 
                                >
                                <span v-if="errors.password" class="invalid-feedback">
                                    {{ errors.password[0] }}
                                </span>
                            </div>

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
                        </div>
                        <div class="col-lg-6">
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
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                </select>
                                <span v-if="errors.is_active" class="invalid-feedback">
                                    {{ errors.is_active[0] }}
                                </span>
                            </div>

                            <div class="form-group">
                                <label class="input-label">
                                    Quyền
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" 
                                    v-model="form.role_id"
                                    :class="{ 'is-invalid': errors.role_id }"
                                >
                                    <option value="0">-- chọn --</option>
                                    <template v-for="role in roles">
                                        <option :value="role.id">{{ role.name }}</option>
                                    </template>
                                </select>
                                <span v-if="errors.role_id" class="invalid-feedback">
                                    {{ errors.role_id[0] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="reset" class="btn btn-secondary" @click="getUser">Đặt lại</button>
                <button type="button" class="btn btn-primary" @click="submitForm">Cập nhật</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import { ref, reactive, onMounted } from "vue";
import imageHelper, { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import inputHelper from "~/Core/helpers/inputHelper";
import roleApi from "~/User/apis/roleApi";
import userApi from "~/User/apis/userApi";
import { useRoute } from "vue-router";

const states = reactive({
    image: IMG_DEFAULT,
});

const route = useRoute();

const errors = ref({});

const form = reactive({
    name: "",
    email: "",
    phone: "",
    password: "",
    role_id: "0",
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

const roles = ref([]);

async function getRoles(){
    try {
        const response = await roleApi.getRoles();
        roles.value = response.data;
    } catch (error) {
    }
}

async function getUser(){
    try {
        const response = await userApi.getUser(route.params.id);
        const data = response.data;
        form.name = data.name;
        form.email = data.email;
        form.phone = data.phone;
        form.role_id = data.role_id;
        form.is_active = data.is_active;
        if(data.image){
            states.image = data.image;
        }
    } catch (error) {
        console.log(error);
    }
}

async function submitForm(){
    try {
        const response = await userApi.updateUser(route.params.id ,form);
    } catch (error) {
        const data = error.response.data;
        errors.value = data.errors;
    }
}

onMounted(async () => { 
    await getRoles();
    await getUser();
});
</script>