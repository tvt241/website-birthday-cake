<template>
    <PageHeaderTitleComponent header-title="Cập nhật mã giảm giá">
        <router-link :to="{ name: 'coupons' }" class="btn btn-primary text-nowrap">
            Danh sách mã giảm giá
        </router-link>
    </PageHeaderTitleComponent>
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
                                Ngân sách
                            </label>
                            <input type="text" 
                                v-model="form.budget" 
                                class="form-control"
                                :class="{ 'is-invalid': errors.budget }"
                            >
                            <span v-if="errors.budget" class="invalid-feedback">
                                {{ errors.budget[0] }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlSelect1">
                                Số lượng
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                v-model="form.quantity" 
                                class="form-control"
                                :class="{ 'is-invalid': errors.quantity }"
                            >
                            <span v-if="errors.quantity" class="invalid-feedback">
                                {{ errors.quantity[0] }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlSelect1">
                                Giới hạn lần người dùng sử dụng
                                <span class="text-danger">*</span>
                            </label>
                            <select name="discount_type" 
                                v-model="form.limit"
                                class="form-control"
                                :class="{ 'is-invalid': errors.discount_type }"
                            >
                                <option value="0">Không</option>
                                <option value="1">Giới hạn</option>
                            </select>
                            <span v-if="errors.limit" class="invalid-feedback">
                                {{ errors.discount_type[0] }}
                            </span>
                        </div>

                        <div class="form-group" v-if="form.limit == '1'">
                            <label class="input-label" for="exampleFormControlSelect1">
                                Số lần giới hạn
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                v-model="form.limit_per_user" 
                                class="form-control"
                                :class="{ 'is-invalid': errors.limit_per_user }"
                            >
                            <span v-if="errors.limit_per_user" class="invalid-feedback">
                                {{ errors.discount_type[0] }}
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-6">
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
                                :class="{ 'is-invalid': errors.discount_value }"
                                v-model="form.discount_value" 
                            >
                            <span v-if="errors.discount_value" class="invalid-feedback">
                                {{ errors.discount_value[0] }}
                            </span>
                        </div>

                        <div class="form-group" v-if="form.discount_type == '2'">
                            <label class="input-label">
                                Giá trị tối đa
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control"
                                :class="{ 'is-invalid': errors.discount_max }"
                                v-model="form.discount_max" 
                            >
                            <span v-if="errors.discount_max" class="invalid-feedback">
                                {{ errors.discount_max[0] }}
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
                                <option value="2">Kích hoạt sau</option>
                                <option value="0">Không kích hoạt</option>
                            </select>
                            <span v-if="errors.is_active" class="invalid-feedback">
                                {{ errors.is_active[0] }}
                            </span>
                        </div>
                        
                        <div v-if="form.is_active == '2'" class="form-group">
                            <label class="input-label" for="exampleFormControlSelect1">
                                Ngày kết thúc
                            </label>
                            <input type="datetime-local" class="form-control"
                                :class="{ 'is-invalid': errors.date_start }"
                                v-model="form.date_start" 
                            >
                            <span v-if="errors.date_start" class="invalid-feedback">
                                {{ errors.date_start[0] }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlSelect1">
                                Ngày kết thúc
                            </label>
                            <input type="datetime-local" class="form-control"
                                :class="{ 'is-invalid': errors.date_end }"
                                v-model="form.date_end" 
                            >
                            <span v-if="errors.date_end" class="invalid-feedback">
                                {{ errors.date_end[0] }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="exampleFormControlSelect1">
                                Mô tả
                            </label>
                            <input type="text" class="form-control"
                                :class="{ 'is-invalid': errors.desc }"
                                v-model="form.desc" 
                            >
                            <span v-if="errors.desc" class="invalid-feedback">
                                {{ errors.desc[0] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end gap-3 mt-4">
            <button type="button"class="btn btn-secondary" @click="getCoupon">Đặt lại</button>
            <button type="button" class="btn btn-primary" @click="submitForm">Cập nhật</button>
        </div>
    </form>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import { ref, reactive, onMounted, onBeforeMount } from "vue";
import imageHelper, { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import inputHelper from "~/Core/helpers/inputHelper";
import couponApi from "~/Coupon/apis/couponApi";
import { useRoute } from "vue-router";
import { formatInt } from "~/Core/helpers/currencyHelper";

const route = useRoute();

const states = reactive({
    image: IMG_DEFAULT,
});

const errors = ref({});

const form = reactive({
    name: "",
    code: "",
    discount_type: "1",
    quantity: 1,
    discount_value: 0,
    discount_max: 0,
    limit: "0",
    limit_per_user: 0,
    date_end: "",
    date_start: "",
    budget: null,
    is_active: 1,
    desc: ""
});

async function submitForm(){
    try {
        const response = await couponApi.addCoupon(form);
        errors.value = {};
    } catch (error) {
        if(error.response.status == 422){
            const data = error.response.data;
            errors.value = data.errors;
        }
    }
}

async function getCoupon() {
    try {
        const response = await couponApi.getCoupon(route.params.id);
        const data = response.data;
        form.name = data.name,
        form.code = data.code,
        form.discount_type = data.discount_type,
        form.quantity = data.quantity,
        form.discount_value = formatInt(data.discount_value),
        form.discount_max = formatInt(data.discount_max),
        form.limit_per_user = data.limit_per_user,
        form.limit = data.limit_per_user ? "1" : "0",
        form.date_end = data.date_end,
        form.date_start = data.date_start,
        form.budget = formatInt(data.budget),
        form.is_active = data.is_active,
        form.desc = data.desc
    } catch (error) {
    }
}

onBeforeMount(async () => {
    await getCoupon();
})

// onMounted()

</script>