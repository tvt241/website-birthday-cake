<template>
    <LoadingComponent :props="loading" />
    <main id="content" role="main" class="main">
        <div class="auth-wrapper">
            <div class="auth-wrapper-left">
                <!-- <div class="auth-left-cont">
                    @php($restaurant_logo=\App\Model\BusinessSetting::where(['key'=>'logo'])->first()->value)
                    <img width="310" src="{{asset('storage/app/public/restaurant/'.$restaurant_logo)}}"
                        onerror="this.src='{{asset('public/assets/admin/img/logo.png')}}'">
                    <h2 class="title">{{translate('your')}} <span class="d-block text-capitalize">{{translate('all_fresh_food')}}</span> <strong class="text--039D55 c1 text-capitalize">{{translate('in_one_place')}}....</strong></h2>
                </div> -->
            </div>
            <div class="auth-wrapper-right">
                <div class="auth-wrapper-form">
                    <form class="" id="form-id" @submit.prevent="login">
                        <div class="auth-header">
                            <div class="mb-5">
                                <h2 class="title">Đăng ký</h2>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label 
                                class="input-label text-capitalize" 
                                for="signinSrEmail"
                            >
                                Tên đăng nhập
                            </label>
                            <input 
                                v-model="form.email_or_phone" 
                                :class="errors.email_or_phone ? 'invalid' : ''" 
                                class="form-control form-control-lg" 
                                id="signinSrEmail"
                                placeholder="Nhập email hoặc số điện thoại"
                                required
                            >
                            <small class="" v-if="errors.email_or_phone">{{ errors.email_or_phone }}</small>
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
                                            :class="showPass.isActive ? 'tio-visible-outlined' : 'tio-hidden-outlined'"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-lg btn-block btn-primary mb-2">Đăng nhập</button>

                        <router-link :to="{ name: 'auth.forgot-password' }" class="text-primary pt-2 mt-2">
                            Quên mật khẩu
                        </router-link>
                    </form>

                    <div 
                        v-if="isProduction === 'local'" 
                        v-for="(user, key) in listUser" 
                        :key="key"
                        class="border-primary pt-5 mt-1"
                    >
                        <h1 class="mt-2 col-12">{{ key }}</h1>
                        <div class="row">
                            <div class="col-10">
                                <span>Email : {{ user.email }}</span>
                                <br>
                                <span>Password : {{ user.password }}</span>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary px-3" @click="copyInfo(key)">
                                    <i class="tio-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script setup>
// import router from "../../../router";
// import alertHelper from "../../../services/alertHelper";
import LoadingComponent from "~/Core/components/LoadingComponent.vue";

import { ref, reactive, onMounted } from "vue";
import ENV from "~/Core/config/env";
const loading = reactive({
    isActive: false
});

const isProduction = ref(ENV.APP_ENV);

const form = reactive({
    email_or_phone: "",
    password: "",
    // remember: false,
});

const showPass = reactive({
    isActive: false,
    type: "password"
})

const errors = ref([]);

const login = () => {
    try {
        loading.isActive = true;
        // this.$store.dispatch('login', this.form).then((res) => {
        //     this.loading.isActive = false;
        //     alertService.success(res.data.message);
        //     if (this.carts.length > 0) {
        //         router.push({ name: "frontend.checkout" });
        //     } else {
        //         router.push({ name: "frontend.home" });
        //     }
        //     router.push({ name: "frontend.home" });
        // }).catch((err) => {
        //     this.loading.isActive = false;
        //     this.errors = err.response.data.errors;
        // })
    } catch (err) {
        loading.isActive = false;
    }
};

function toggleShowPass(){
    const isShow = showPass.isActive == true ? false : true;
    showPass.isActive = isShow;
    showPass.type = isShow ? "text" : "password";
}

const checkEmailOrPhone = (event) => {

};

// onMounted(() => {
//     loading.isActive = true;
// });

const listUser = {
    Admin: {
        email: "admin@example.com",
        password: "12345678"
    },
    Employee: {
        email: "employee@example.com",
        password: "12345678"
    },
}

function copyInfo(keyCopy) {
    for (const key in listUser) {
        if(key == keyCopy){
            form.email_or_phone = listUser[key].email;
            form.password = listUser[key].password;
            break;
        }
    }
}
</script>
