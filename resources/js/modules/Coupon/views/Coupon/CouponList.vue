<template>
    <PageHeaderTitleComponent header-title="Danh sách mã giảm giá">
        <router-link :to="{ name: 'coupons.create' }"  class="btn btn-primary text-nowrap">
            <i class="mdi mdi-plus"></i>
            Thêm
        </router-link>
    </PageHeaderTitleComponent>
    <div class="row g-2">
        <div class="col-12">
            <!-- Card -->
            <div class="card">

                <div class="py-4">
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Mã</th>
                                    <th>Tên</th>
                                    <th>Còn lại</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th class="text-center">Khác</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(coupon, index) in coupons.data">
                                    <td class="vertical-middle">{{ index + 1 }}</td>
                                    <td>{{ coupon.code }} </td>
                                    <td>{{ coupon.name }}</td>
                                    <td>{{ coupon.available + "/ " + coupon.quantity }}</td>
                                    <td>{{ coupon.active_name }}</td>
                                    <td>{{ coupon.date_start }}</td>
                                    <td>{{ coupon.date_end }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <router-link 
                                                class="btn btn-outline-info btn-sm edit square-btn"
                                                :to="{ name: 'coupons.details', params: { id: coupon.id }}"
                                            >
                                                <i class="mdi mdi-eye"></i>
                                            </router-link>
                                            <router-link 
                                                class="btn btn-outline-warning btn-sm edit square-btn"
                                                :to="{ name: 'coupons.edit', params: { id: coupon.id }}"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </router-link>
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm delete square-btn"
                                                @click="onShowConfirm(coupon.id)">
                                                <i class="mdi mdi-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4 px-3">
                        <div class="d-flex justify-content-lg-end">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import alertHelper from "~/Core/helpers/alertHelper";
import couponApi from "~/Coupon/apis/couponApi";

const coupons = ref({});

const filter = reactive({
    page: 1
});

async function getCouponsPaginate(page = 1) {
    filter.page = page;
    try {
        const response = await couponApi.getCouponsPaginate(filter);
        coupons.value = response.data;
    } catch (error) {

    }
}

function onShowConfirm(id) {
    alertHelper.confirmDelete()
        .then((result) => {
            if (result.isConfirmed) {
                deleteCoupon(id);
            }
        })
}

async function deleteCoupon(id){
    try {
        await couponApi.deleteCoupon(id);
        getCouponsPaginate();
    } catch (error) {

    }
}

onMounted(async () => { 
   await getCouponsPaginate();
});

</script>

<style>
td{
    vertical-align: middle !important;
}
</style>