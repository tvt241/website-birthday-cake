<template>
    <PageHeaderTitleComponent header-title="Chi tiết mã giảm giá">
        <div>
            <router-link :to="{ name: 'coupons.edit', params: { id: route.params.id } }" class="btn btn-primary text-nowrap mr-2">
                Cập nhật
            </router-link>

            <router-link :to="{ name: 'coupons' }" class="btn btn-primary text-nowrap">
                Danh sách mã giảm giá
            </router-link>
        </div>
        
    </PageHeaderTitleComponent>
    <div class="col-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="mb-0 d-flex gap-2 align-items-center">
                            Thông tin mã giảm giá
                        </h4>
                    </div>
                    <div class="card card-body h-100">
                        <div class="row coupon-info">
                            <div class="col-md-6">
                                <p>Tên: <span>{{ coupon.name }}</span></p>
                                <p>Mã: <span>{{ coupon.code }}</span></p>
                                <p>Ngày tạo: <span>{{ coupon.created_at }}</span></p>
                                <p>Ngày bắt đầu: <span>{{ coupon.date_start }}</span></p>
                                <p>Ngày kết thúc: <span>{{ coupon.date_end }}</span></p>
                            </div>

                            <div class="col-md-6">
                                <p>Tình trạng: <span>{{ coupon.active_name }}</span></p>
                                <p>Số lượng: <span>{{ coupon.available }} / {{ coupon.quantity }}</span></p>
                                <p>Ngân sách: <span>{{ formatCurrency(coupon.budget_available) }} / {{ formatCurrency(coupon.budget) }}</span></p>
                                <p>Mô tả: <span>{{ coupon.desc }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card card-body h-100">
                        <div class="row">
                            <div class="card-header">
                                <h4>Đơn hàng đã sử dụng</h4>
                            </div>
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Khách hàng</th>
                                        <th>Tông tiền</th>
                                        <th>Giảm giá</th>
                                        <th>Thanh toán</th>
                                    </thead>
                                    <tbody>
                                        <tr v-if="coupon.orders" v-for="(order, index) in coupon.orders">
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <router-link :to="{ name: 'orders.details', params: { id: order.id }}">
                                                    {{ order.order_code }}
                                                </router-link>
                                            </td>
                                            <td>
                                                <a class="text-dark" href="#">{{ order.name }}</a>
                                            </td>
                                            <td>{{ formatCurrency(order.total)   }}</td>
                                            <td>{{ formatCurrency(order.coupon_value) }}</td>
                                            <td>{{ formatCurrency(order.amount) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import { ref, reactive, onMounted } from "vue";
import imageHelper, { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import { formatCurrency } from "~/Core/helpers/currencyHelper";
import { useRoute } from "vue-router";
import couponApi from "~/Coupon/apis/couponApi";

const route = useRoute();

const coupon = ref({});

async function getCoupon() {
    try {
        const response = await couponApi.getCoupon(route.params.id);
        const data = response.data;
        coupon.value = data;
    } catch (error) {
    }
}

onMounted(async () => { 
    await getCoupon();
});
</script>

<style scoped>
    .coupon-info p{
        color: black;
        padding-bottom: 10px;
    }

    .coupon-info span{
        float: right;
    }
</style>