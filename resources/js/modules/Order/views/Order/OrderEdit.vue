<template>
    <PageHeaderTitleComponent header-title="Cập nhật đơn hàng">
        <router-link :to="{ name: 'orders' }" class="btn btn-primary text-nowrap">
            Danh sách đơn hàng
        </router-link>
    </PageHeaderTitleComponent>
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0 d-flex gap-2 align-items-center">
                Thông tin đơn hàng
            </h4>
        </div>
        <div class="card card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Mã đơn hàng</label>
                        <input type="" :value="form.order_code" readonly class="form-control"id="">
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Tên người nhận</label>
                        <input type="" v-model="form.name" class="form-control"id="">
                    </div>

                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="" v-model="form.phone" class="form-control"id="">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="" v-model="form.email" class="form-control"id="">
                    </div>

                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="" v-model="form.address" class="form-control"id="">
                    </div>

                    <div class="form-group">
                        <label for="">Địa chỉ cụ thể</label>
                        <input type="" v-model="form.address2" class="form-control"id="">
                    </div>
                </div>
                <div class="col-md-12 d-flex gap-2 justify-content-end">
                    <button type="button" @click="getOrder" class="btn btn-warning">Làm mới</button>
                    <button type="button" @click="onSubmit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import { ref, reactive, onMounted } from "vue";
import orderApi from "~/Order/apis/orderApi";
import { useRoute, useRouter } from "vue-router";
import alertHelper from "~/Core/helpers/alertHelper";
import customerApi from "~/Customer/apis/customerApi";

const route = useRoute();
const router = useRouter();

function resetPage(){
    router.go();
}


const form = reactive({
    order_code: "",
    order_status: "",
    payment_method: "",
    payment_status: "",
    user_id: "",
    status: "",
    name: "",
    phone: "",
    email: "",
    address: "",
    address2: ""
});

async function getOrder() {
    try {
        const response = await orderApi.getOrder(route.params.id);
        const data = response.data;
        form.name = data.name;
        form.email = data.email;
        form.phone = data.phone;
        form.address = data.address;
        form.address2 = data.address2;
        form.order_code = data.order_code;
        form.status = data.status_id;
        form.payment_method = data.payment_method_id;
        form.payment_status = data.payment_status_id;
    } catch (error) {
        console.log(error);
    }
}

async function onSubmit() {
    try {
        const response = await orderApi.updateOrder(route.params.id, form);
    } catch (error) {
        console.log(error);
    }
}

const customers = ref([]);

async function getCustomers() {
    try {
        const response = await customerApi.getCustomersPaginate();
        customers.value = response.data.data;
    } catch (error) {
        console.log(error);
    }
}

onMounted(async () => { 
    await getCustomers();
    await getOrder();
});
</script>
<!-- 
<div class="form-group">
    <label for="">Tình trạng đơn hàng</label>
    <select v-model="form.status" class="form-control">
        <option class="text-danger" disabled>Chờ sử lý</option>
        <option value="0">Chờ duyệt</option>
        <option value="1">Chuẩn bị hàng</option>
        <option value="2">Đã bàn giao đơn vị vận chuyển</option>
        <option value="3">Đang vận chuyển</option>
        <option value="4">Đang giao đến bạn</option>
        <option value="5">Đã giao</option>
        <option class="text-danger" disabled>Thất bại</option>
        <option value="23">Giao thất bại</option>
        <option value="23">Tạm dừng</option>
        <option value="21">Người bán hủy</option>
        <option value="20">Khách hàng hủy</option>
        <option value="20">Hoàn hàng</option>
        <option value="20">Trả hàng</option>

        <option class="text-danger" disabled>Thành công </option>
        <option value="10">Hoàn thành</option>
    </select>
</div>

<div class="form-group">
    <label>Kiểu thanh toán</label>
    <select  v-model="form.payment_method" name="" id="" class="form-control">
        <option value="0">COD</option>
        <option value="1">VNPAY</option>
        <option value="2">Tiền mặt</option>
    </select>
</div>

<div class="form-group">
    <label for="">Trạng thái thanh toán</label>
    <select v-model="form.payment_status" name="" id="" class="form-control">
        <option value="0">Chờ thanh toán</option>
        <option value="1">Đã thanh toán</option>
        <option value="2">Thanh toán thiếu</option>
    </select>
</div>

<div class="form-group">
    <label for="">Khách hàng</label>
    <select v-model="form.user_id" name="" id="" class="form-control">
        <option value="">Khách lẻ</option>
        <option v-for="customer in customers" :value="customer.id">{{ customer.name }}</option>
    </select>
</div> -->