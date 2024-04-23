<template>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="mail_host">Mail host</label>
                <input type="text" class="form-control" id="mail_host" v-model="form.mail_host" required autocomplete="off">
            </div>

            <div class="form-group">
                <label for="mail_port">Mail port</label>
                <input type="text" class="form-control" id="mail_port" v-model="form.mail_port" required autocomplete="off">
            </div>

            <div class="form-group">
                <label for="mail_username">Mail</label>
                <input type="text" class="form-control" id="mail_username" v-model="form.mail_username" required
                    autocomplete="off">
            </div>

            <InputPasswordComponent v-model:passwordValue="form.mail_password"></InputPasswordComponent>

            <div class="form-group">
                <label for="mail_encryption">Kiểu mã hóa</label>
                <input type="text" class="form-control" id="mail_encryption" v-model="form.mail_encryption" required
                    autocomplete="off">
            </div>

            <div class="btn--container">
                <button type="reset" class="btn btn-secondary">Đặt lại</button>
                <button @click="save" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, reactive } from "vue";
import settingApi from "~/Setting/api/settingApi";
import InputPasswordComponent from "~/Core/components/Input/InputPasswordComponent.vue";
import imageHelper, { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import toastHelper from '~/Core/helpers/toastHelper';

const form = reactive({
    mail_mailer: "",
    mail_host: "",
    mail_port: "",
    mail_username: "",
    mail_password: "",
    mail_encryption: ""
});

async function getConfig(){
    try {
        const response = await settingApi.getService("mail");
        // response.data.forEach(config => {
        //     form[config.key] = config.value;
        // });
    } catch (error) {
    }
}

onMounted(() => {
    getConfig();
})

</script>