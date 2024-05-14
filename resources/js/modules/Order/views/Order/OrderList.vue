<template>
    <PageHeaderTitleComponent header-title="Danh sách đơn hàng">
        <router-link :to="{ name: 'posts.create' }"  class="btn btn-primary text-nowrap">
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
                                    <th>Mã đơn hàng</th>
                                    <th>Loại đơn hàng</th>
                                    <th>Kênh bán</th>
                                    <th>Người mua hàng</th>
                                    <th>Thanh toán</th>
                                    <th>Tình trạng</th>
                                    <th class="text-center">Khác</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(order, index) in orders.data">
                                    <td class="vertical-middle">{{ index + 1 }}</td>
                                    <td>{{ order.order_code }} </td>
                                    <td>{{ order.order_type }} </td>
                                    <td>{{ order.order_channel }}</td>
                                    <td>{{ order.customer_name }}</td>
                                    <td>{{ order.payment_method + " - " + order.payment_status }}</td>
                                    <td>{{ order.status }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <router-link 
                                                class="btn btn-outline-info btn-sm edit square-btn"
                                                :to="{ name: 'orders.details', params: { id: order.id }}"
                                            >
                                                <i class="mdi mdi-eye"></i>
                                            </router-link>
                                            <router-link 
                                                class="btn btn-outline-warning btn-sm edit square-btn"
                                                :to="{ name: 'orders.edit', params: { id: order.id }}"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </router-link>
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm delete square-btn"
                                                @click="onShowConfirm(order.id)">
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
import orderApi from "~/Order/apis/orderApi";

const orders = ref({});

const filter = reactive({
    page: 1
});

async function getOrdersPaginate(page = 1) {
    filter.page = page;
    try {
        const response = await orderApi.getOrdersPaginate(filter);
        orders.value = response.data;
    } catch (error) {

    }
}

function onShowConfirm(id) {
    alertHelper.confirmDelete()
        .then((result) => {
            if (result.isConfirmed) {
                deleteOrder(id);
            }
        })
}

async function deleteOrder(id){
    try {
        await orderApi.deleteOrder(id);
        getOrdersPaginate();
    } catch (error) {

    }
}

onMounted(async () => { 
   await getOrdersPaginate();
});

</script>

<style>
td{
    vertical-align: middle !important;
}
</style>