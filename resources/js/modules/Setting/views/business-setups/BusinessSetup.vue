<template>
    <div class="card mt-3">
        <div class="card card-body h-100">
            <div class="d-flex justify-content-between align-items-center border rounded mb-2 px-3 py-2">
                <h5 class="mb-0 c1">
                    Bảo trì
                </h5>
                <label class="switcher ml-auto mb-0">
                    <input type="checkbox" class="switcher_input">
                    <span class="switcher_control"></span>
                </label>
            </div>
            <p>* Khi bật chế độ bảo trì website và app ở chế độ người dùng sẽ không thể truy cập</p>
        </div>
    </div>
    
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0 d-flex gap-2 align-items-center">
                <i class="tio-canvas-text"></i>
                Thông tin công ty
            </h4>
        </div>
        <div class="card card-body h-100">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="input-label">Tên công ty</label>
                        <input type="text" v-model="form.name" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="input-label">Số điện thoại</label>
                        <input type="text" v-model="form.phone" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="input-label">Email</label>
                        <input type="text" v-model="form.email" class="form-control">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="input-label">Địa chỉ</label>
                        <textarea type="text" v-model="form.address" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="input-label">Logo</label>
                        <div class="custom-file">
                            <input type="file" name="logo" id="logo"  @change="previewImage($event, 'logo')"  class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                            <label class="custom-file-label" for="logo">Choose File</label>
                        </div>
                        <div class="text-center mt-3">
                            <img style="height: 100px; border-radius: 10px;" :src="states.logo ?? IMG_DEFAULT" alt="logo image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="input-label">Fav Icon</label>
                        <div class="custom-file">
                            <input type="file" name="logo" id="fav-icon"  @change="previewImage($event, 'fav_icon')"  class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                            <label class="custom-file-label" for="fav-icon">Choose File</label>
                        </div>
                        <div class="text-center mt-3">
                            <img style="height: 100px; border-radius: 10px;" :src="states.fav_icon ?? IMG_DEFAULT" alt="logo image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="input-label">Vĩ độ</label>
                        <input type="text" v-model="form.latitude" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="input-label">Kinh độ</label>
                        <input type="text" v-model="form.longitude" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="input-label">Zoom</label>
                        <input type="text" v-model="form.zoom" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6">
                    <iframe class="w-100 iframe-map" style="height: 270px;" loading="lazy" allowfullscreen
                        :src="'https://www.google.com/maps/embed/v1/place?key=AIzaSyBjyAuhSLp4OkdsVq-SwTCJ-yNYIKC77mo&q=' + form.latitude +',' + form.longitude + '&zoom=' + form.zoom + '&maptype=satellite'">
                    </iframe>
                </div>
                <div class="col-lg-12 d-flex justify-content-end mt-2">
                    <button @click="submitForm"class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </div>
    </div>

</template>
<script setup>
import { ref, onMounted, reactive } from "vue";
import imageHelper, { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import settingApi from "~/Setting/api/settingApi";

const states = reactive({
    logo: "",
    fav_icon: ""
});

async function previewImage(event, key) {
    try {
        const result = await imageHelper.previewImage(event);
        states[key] = result.image_src;
        form[key] = result.image;
    } catch (error) {
        console.log(error);
    }
}

const form = reactive({
    name: "",
    phone: "",
    email: "",
    address: "",
    logo: {},
    fav_icon: {},
    latitude: 0,
    longitude: 0,
    zoom: 0
});

async function getConfig(){
    try {
        const formTemp = {};
        const response = await settingApi.getConfig("company");
        response.data.forEach(config => {
            formTemp[config.key] = config.value
        });
        form.name = formTemp.name;
        form.phone = formTemp.phone;
        form.email = formTemp.email;
        form.address = formTemp.address;
        states.logo = formTemp.logo;
        states.fav_icon = formTemp.fav_icon;
        form.latitude = formTemp.latitude;
        form.longitude = formTemp.longitude;
        form.zoom = formTemp.zoom;
    } catch (error) {
    }
}

async function submitForm(){
    try {
        const response = await settingApi.setConfig("company", form);
        console.log(response);
    } catch (error) {
    }
}

onMounted(() => {
    getConfig();
})
</script>