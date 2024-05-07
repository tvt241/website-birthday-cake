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
                        <div class="row align-items-end justify-content-md-end">
                            <div class="col-xl-3 col-md-4">
                                <div class="form-group">
                                    <label for="">Tình trạng đơn hàng</label>
                                    <select @change="confirmUpdateOrder($event, 'status')" v-model="order.status_id" class="form-control">
                                        <option class="text-danger" disabled>Chờ sử lý</option>
                                        <option value="0">Chờ duyệt</option>
                                        <option value="1">Chuẩn bị hàng</option>
                                        <option value="2">Đã bàn giao đơn vị vận chuyển</option>
                                        <option value="3">Đang vận chuyển</option>
                                        <option value="4">Đang giao đến bạn</option>
                                        <option value="5">Đã giao</option>
                                        <!-- <option disabled value="11">Hoàn thành tự động</option> -->
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
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="form-group">
                                    <label>Kiểu thanh toán</label>
                                    <select @change="confirmUpdateOrder($event, 'payment_method')"  v-model="order.payment_method_id" name="" id="" class="form-control">
                                        <option value="0">COD</option>
                                        <option value="1">VNPAY</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4">
                                <div class="form-group">
                                    <label for="">Trạng thái thanh toán</label>
                                    <select @change="confirmUpdateOrder($event, 'payment_status')"  v-model="order.payment_status_id" name="" id="" class="form-control">
                                        <option value="0">Chờ thanh toán</option>
                                        <option value="1">Đã thanh toán</option>
                                        <option value="2">Thanh toán thiếu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="form-group d-flex gap-2 justify-content-end">
                                    <button class="btn btn-primary">Chuyển giao hàng</button>
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
                        <p>Mã đơn hàng: <b>{{ order.order_code }}</b></p>
                        <p>Kênh bán: <b>{{ order.order_type }}</b></p>
                        <p>Kiểu thanh toán: <b>{{ order.payment_method }}</b></p>
                        <p>Tình trạng thanh toán: <b>{{ order.payment_status }}</b></p>
                        <p>Ngày tạo: <b>{{ order.created_at }}</b></p>
                        <p>Ngày nhận: <b>{{ order.completed_at }}</b></p>
                        <p>Tiền hàng: <b>{{ order.total }}</b></p>
                        <p>Giảm giá: <b>{{ order.coupon_value }}</b></p>
                        <p>Phí ship: <b>{{ order.shipping_price }}</b></p>
                        <p>Tổng tiền: <b>{{ order.amount }}</b></p>
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
                        <p>Tên khách hàng: <b>{{ order.customer_name }}</b></p>
                        <p>Tên người nhận: <b>{{ order.name }}</b></p>
                        <p>Số điện thoại người nhận: <b>{{ order.phone }}</b></p>
                        <p>Địa chỉ: <b>{{ order.address }}</b></p>
                        <p>Chi tiết: <b>{{ order.address2 }}</b></p>
                        <!-- <p>Số đơn hàng đã mua: {{ order.address2 }}</p> -->
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
                                        <tr v-if="order.details?.length" v-for="(details, index) in order.details">
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
import alertHelper from "~/Core/helpers/alertHelper";

const route = useRoute();

const order = ref({
});


async function getOrder() {
    try {
        const response = await orderApi.getOrder(route.params.id);
        const data = response.data;
        order.value = data;
    } catch (error) {
    }
}

function confirmUpdateOrder(e, key){
    alertHelper.confirmDelete()
        .then((result) => {
            if (result.isConfirmed) {
                const data = {
                    [key]: e.target.value
                }
                updateOrder(data);
            }
        })
}
async function updateOrder(data) {
    try {
        const response = await orderApi.updateOrder(route.params.id, data);
        const data = response.data;
        order.value = data;
    } catch (error) {
    }
}

onMounted(async () => { 
    await getOrder();
});
</script>

<style scoped>
    p{
        color: black;
        padding-bottom: 10px;
    }
    p b{
        float: right;
    }
</style>