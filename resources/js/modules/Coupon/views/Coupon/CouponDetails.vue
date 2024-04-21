<template>
    <PageHeaderTitleComponent header-title="Chi tiết đơn hàng">
        <router-link :to="{ name: 'orders' }" class="btn btn-primary text-nowrap">
            Danh sách đơn hàng
        </router-link>
    </PageHeaderTitleComponent>
    <div class="col-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card card-body">
                        <div class="row align-items-end">
                            <div class="col-lg-3 col-md-4">
                                <div class="form-group">
                                    <label for="">Tình trạng đơn hàng</label>
                                    <select name="" id="" class="form-control">
                                        <option value="0">Chờ duyệt</option>
                                        <option value="1">Chuẩn bị hàng</option>
                                        <option value="2">Đã bàn giao đơn vị vận chuyển</option>
                                        <option value="3">Đang vận chuyển</option>
                                        <option value="4">Đang giao đến bạn</option>
                                        <option value="5">Đã giao</option>
                                        <option value="6">Chờ khách hàng xác nhận</option>
                                        <option value="7">Hoàn thành</option>
                                        <option disabled value="8">Hoàn thành tự động</option>
                                        <option disabled value="11">Giao thất bại</option>
                                        <option class="text-danger" value="10"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="form-group">
                                    <label for="">Kiểu thanh toán</label>
                                    <select name="" id="" class="form-control">
                                        <option value="0">COD</option>
                                        <option value="1">VNPAY</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="form-group">
                                    <label for="">Trạng thái thanh toán</label>
                                    <select name="" id="" class="form-control">
                                        <option value="0">Chờ thanh toán</option>
                                        <option value="1">Thanh toán thiếu</option>
                                        <option value="2">Đã thanh toán</option>
                                    </select>
                                </div>
                            </div>                
                            <div class="col-lg-3 col-md-4 justify-content-end">
                                <div class="form-group d-flex gap-2 justify-content-center">
                                    <button class="btn btn-primary">Cập nhật</button>
                                    <button class="btn btn-primary">In hóa đơn</button>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="mb-0 d-flex gap-2 align-items-center">
                            Thông tin đơn hàng
                        </h4>
                    </div>
                    <div class="card card-body h-100">
                        <p>Mã đơn hàng: {{ order.order_code }}</p>
                        <p>Kênh bán: {{ order.order_type }}</p>
                        <p>Kiểu thanh toán: {{ order.payment_method }}</p>
                        <p>Tình trạng thanh toán: {{ order.payment_status }}</p>
                        <p>Ngày tạo: {{ order.created_at }}</p>
                        <p>Ngày nhận: {{ order.order_date }}</p>
                        <p>Tiền hàng: {{ order.total }}</p>
                        <p>Giảm giá: {{ order.coupon_value }}</p>
                        <p>Phí ship: {{ order.order_date }}</p>
                        <p>Tổng tiền: {{ order.amount }}</p>
                        <p>Ghi chú: {{ order.note }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4 class="mb-0 d-flex gap-2 align-items-center">
                            Thông tin khách hàng
                        </h4>
                    </div>
                    <div class="card card-body h-100">
                        <p>Tên khách hàng: {{ order.customer_name }}</p>
                        <p>Tên người nhận: {{ order.name }}</p>
                        <p>Số điện thoại người nhận: {{ order.phone }}</p>
                        <p>Địa chỉ: {{ order.address }}</p>
                        <p>Chi tiết: {{ order.address2 }}</p>
                        <p>Số đơn hàng đã mua: {{ order.address2 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mt-3">
                    <div class="card card-body h-100">
                        <div class="row">
                            <div class="card-header">
                                <h4>Chi tiết đơn hàng</h4>
                            </div>
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Chi tiết</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                    </thead>
                                    <tbody>
                                        <tr v-if="orderDetails.length" v-for="(details, index) in orderDetails">
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <div class="media align-items-center gap-3">
                                                    <div class="avatar">
                                                        <img :src="details.image ? details.image : IMG_DEFAULT" class="rounded img-fit">
                                                    </div>
                                                    <div class="media-body">
                                                        <a class="text-dark" href="#">{{ details.name }}</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ details.info }}</td>
                                            <td class="text-right">{{ formatCurrency(details.price) }}</td>
                                            <td class="text-right">{{ details.quantity }}</td>
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
import orderApi from "~/Order/apis/orderApi";
import { useRoute } from "vue-router";

const route = useRoute();

const order = ref({});
const orderDetails = ref([]);


async function getOrder() {
    try {
        const response = await orderApi.getOrder(route.params.id);
        const data = response.data;
        order.value = data.order;
        orderDetails.value = data.details;
    } catch (error) {
    }
}

onMounted(async () => { 
    await getOrder();
});
</script>