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
                                <h2 class="title">{{ $t('label.sign_in') }}</h2>
                                <div class="text-capitalize">{{ $t("label.welcome_back") }}</div>
                                <p class="mb-0 text-capitalize">{{ $t("message.want_to_login_your_admin") }}?
                                    <a href="">
                                        {{ $t("label.branch_login") }}
                                    </a>
                                </p>
                                <span class="badge mt-2">( {{ $t("message.admin_or_employee_sign_in") }} )</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label 
                                class="input-label text-capitalize" 
                                for="signinSrEmail"
                            >
                                {{ $t('label.email_or_phone') }}
                            </label>
                            <input 
                                v-model="form.email_or_phone" 
                                :class="errors.email_or_phone ? 'invalid' : ''" 
                                class="form-control form-control-lg" 
                                id="signinSrEmail"
                                placeholder="email@address.com"
                                required
                            >
                            <small class="" v-if="errors.email_or_phone">{{ errors.email_or_phone }}</small>
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="signupSrPassword" tabindex="0">
                                    <span class="d-flex justify-content-between align-items-center">
                                    {{ $t('label.password') }}
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
<!-- 
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input 
                                    type="checkbox"

                                    class="custom-control-input" 
                                    id="termsCheckbox">
                                <label class="custom-control-label text-muted" for="termsCheckbox">
                                    {{ $t('label.remember_me') }}
                                </label>
                            </div>
                        </div> -->

                        <!-- {{-- recaptcha --}}
                        @php($recaptcha = \App\CentralLogics\Helpers::get_business_settings('recaptcha'))
                        @if(isset($recaptcha) && $recaptcha['status'] == 1)
                            <div id="recaptcha_element" class="w-100" data-type="image"></div>
                            <br/>
                        @else
                            <div class="row p-2">
                                <div class="col-5 pr-0">
                                    <input type="text" class="form-control form-control-lg" name="default_captcha_value" value=""
                                        placeholder="{{translate('Enter captcha value')}}" style="border: none" autocomplete="off">
                                </div>
                                <div class="col-7 input-icons" class="bg-white rounded">
                                    <a onclick="javascript:re_captcha();">
                                        <img src="{{ URL('/branch/auth/code/captcha/1') }}" class="input-field" id="default_recaptcha_id" style="display: inline;width: 80%; height: 75%">
                                        <i class="tio-refresh icon"></i>
                                    </a>
                                </div>
                            </div>
                        @endif -->

                        <button type="submit" class="btn btn-lg btn-block btn-primary mb-2">{{ $t('label.sign_in') }}</button>

                        <router-link :to="{ name: 'auth.forgot-password' }" class="text-primary pt-2 mt-2">
                            {{ $t('label.forgot_password') }}
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
