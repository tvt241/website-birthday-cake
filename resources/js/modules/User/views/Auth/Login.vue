<template>
    <main id="content" role="main" class="main">
        <div class="auth-wrapper">
            <div class="auth-wrapper-left" :style="{ backgroundImage: 'url(' + IMG_FOLDER + 'logo-login.jpg)' , backgroundPosition: 'center', backgroundSize: 'cover' }">
            </div>
            <div class="auth-wrapper-right">
                <div class="auth-wrapper-form">
                    <form class="" id="form-id" @submit.prevent="login">
                        <div class="auth-header">
                            <div class="mb-5">
                                <h2 class="title">Đăng nhập</h2>
                                <div class="text-capitalize">Chào mửng trở lại</div>
                                <p class="mb-0 text-capitalize">Bạn không phải nhân viên?
                                    <a href="">
                                        Người dùng đăng nhâp
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label 
                                class="input-label text-capitalize" 
                                for="username"
                            >
                                Tên đăng nhập
                            </label>
                            <input 
                                v-model="form.username" 
                                :class="errors.username ? 'invalid' : ''" 
                                class="form-control form-control-lg" 
                                id="username"
                                placeholder="email@address.com"
                                required
                            >
                            <small class="" v-if="errors.username">{{ errors.username }}</small>
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="signupSrPassword" tabindex="0">
                                    <span class="d-flex justify-content-between align-items-center">
                                    Mật khẩu
                                    </span>
                            </label>

                            <div class="input-group input-group-merge">
                                <input 
                                    v-model="form.password"
                                    :type="showPass.type"
                                    :class="errors.password ? 'invalid' : ''"
                                    class="form-control form-control-lg"
                                    id=""
                                    placeholder="12345678"
                                    required
                                >
                                <div id="changePassTarget" class="input-group-append">
                                    <a class="input-group-text" href="javascript:">
                                        <i id="changePassIcon" 
                                            @click="toggleShowPass" 
                                            class="mdi"
                                            :class="showPass.isActive ? 'mdi-eye ' : 'mdi-eye-off'"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-primary mb-2">Đăng nhập</button>
                    </form>

                    <div class="border-primary pt-5 mt-1">
                        <div v-if="isProduction === 'local'"  v-for="(user, key) in listUser" :key="key">
                            <h2 class="mt-3 col-12">{{ key }}</h2>
                            <div class="row">
                                <div class="col-10">
                                    <span>Email : {{ user.email }}</span>
                                    <br>
                                    <span>Password : {{ user.password }}</span>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary px-3" @click="copyInfo(key)">
                                        <i class="mdi mdi-content-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";
import { useAuthStore } from "../../store/authStore";
import ENV from "~/Core/config/env";
import authApi from "~/User/apis/authApi";
import { IMG_FOLDER } from "~/Core/helpers/imageHelper";
import { useRouter } from "vue-router";
import alertHelper from "~/Core/helpers/alertHelper";

const store = useAuthStore();

const router = useRouter();

window.router = router;

const isProduction = ref(ENV.APP_ENV);

const form = reactive({
    username: "",
    password: "",
    // remember: false,
});

const errors = ref([]);

async function login(){
    try {
        const response = await authApi.login(form);
        const data = response.data;
        await store.setToken(data);
        router.push({name: "pos"});
    } catch (error) {
        alertHelper.error(error.response.data.message);
    }
};

const showPass = reactive({
    isActive: false,
    type: "password"
})

function toggleShowPass(){
    const isShow = showPass.isActive == true ? false : true;
    showPass.isActive = isShow;
    showPass.type = isShow ? "text" : "password";
}

onMounted(() => {
    store.retry = false;
});

const listUser = {
    Admin: {
        email: "admin@gmail.com",
        password: "12345678"
    },
    // Employee: {
    //     email: "employee@gmail.com",
    //     password: "12345678"
    // },
}

function copyInfo(keyCopy) {
    for (const key in listUser) {
        if(key == keyCopy){
            form.username = listUser[key].email;
            form.password = listUser[key].password;
            break;
        }
    }
}
</script>
