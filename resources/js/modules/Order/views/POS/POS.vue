<template>
    <div class="row">
        <ProductSelectComponent
            @product-selected="onProductSelected"
        />
        <div class="col-lg-6">
            <div class="card billing-section-wrap">
                <div class="pos-title">
                    <h4 class="mb-0">Thanh toán</h4>
                </div>

                <div class="p-2 p-sm-4">
                    <div class="form-group d-flex gap-2">
                        <select v-model="form.user_id" class="form-control">
                            <option v-for="customer in customers" :value="customer.id">{{ customer.text }}</option>
                        </select>
                        
                        <button class="btn btn-success rounded text-nowrap" 
                            id="add_new_customer" 
                            type="button" 
                            data-toggle="modal" 
                            data-target="#add-customer" 

                            title="Thêm người dùng"
                        >
                            <i class="mdi mdi-plus"></i>
                            Người dùng
                        </button>
                    </div>

                    <div class="form-group d-flex gap-2">
                        <input type="text" v-model="form.coupon_code" class="form-control" placeholder="Mã giảm giá">
                        <button class="btn btn-primary rounded text-nowrap" @click="checkCouponValue">
                            Kiểm tra
                        </button>
                    </div>

                    <div class="form-group">
                        <label class="input-label font-weight-semibold fz-16 text-dark">Loại đơn hàng</label>
                        <div class="">
                            <div class="form-control d-flex flex-column-3">
                                <label class="custom-radio d-flex gap-2 align-items-center m-0">
                                    <input type="radio" value="0" v-model="form.order_type" name="oder_type">
                                    <span class="media align-items-center mb-0">
                                        <span class="media-body">Đơn bán</span>
                                    </span>
                                </label>

                                <label class="custom-radio d-flex gap-2 align-items-center m-0">
                                    <input type="radio" value="1" v-model="form.order_type" name="oder_type">
                                    <span class="media align-items-center mb-0">
                                        <span class="media-body">Đơn đặt</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div v-if="form.order_type == '1'" class="form-group">
                        <label for="">Địa chỉ giao hàng</label>
                        <input type="text" v-model="form.address2" class="form-control" placeholder="Nhập địa chỉ">
                    </div>

                    <div class="w-100" id="cart">
                        <div class="table-responsive pos-cart-table border">
                            <table class="table table-align-middle mb-0">
                                <thead class="text-dark bg-light">
                                    <tr>
                                        <th class="text-capitalize border-0 min-w-120">Sản phẩm</th>
                                        <th class="text-capitalize border-0">SL</th>
                                        <th class="text-capitalize border-0">Giá</th>
                                        <th class="text-capitalize border-0">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(product, index) in form.products">
                                        <td>
                                            <div class="media align-items-center gap-10">
                                                <img class="avatar avatar-sm" :src="product.image_url ?? IMG_DEFAULT">
                                                <div class="media-body">
                                                    <span class="text-hover-primary mb-0">
                                                        {{ product.name }}
                                                    </span>
                                                    <small class="d-block">{{ product.variation }} ( {{ formatCurrency(product.price) }} )</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control qty" @change="onUpdateQuantityProduct($event, index)" :value="product.quantity" min="1">
                                        </td>
                                        <td>
                                            <div class="">
                                                {{ totalPriceProduct(product) }}
                                            </div>
                                        </td>
                                        <td class="justify-content-center gap-2">
                                            <a href="javascript:void(0)" @click="onRemoveProduct(index)" class="btn btn-sm btn-outline-danger square-btn form-control">
                                                <i class="mdi mdi-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="pos-data-table p-3">
                            <dl class="row">
                                <dt class="col-6">Tiền hàng: </dt>
                                <dd class="col-6 text-right">{{ formatCurrency(form.total_price) }}</dd>

                                <dt class="col-6">Giảm giá: </dt>
                                <dd class="col-6 text-right">- {{ formatCurrency(form.coupon_value) }}</dd>

                                <template v-if="form.order_type == '1'">
                                    <dt class="col-6">Phí ship :</dt>
                                    <dd class="col-6 text-right"> 0</dd>
                                </template>

                                <dt class="col-6 border-top font-weight-bold pt-2">Tổng tiền: </dt>
                                <dd class="col-6 text-right border-top font-weight-bold pt-2">
                                    {{ formatCurrency(form.amount) }}
                                </dd>

                                <dt class="col-6 font-weight-bold pt-2">Khách trả: </dt>
                                <dd class="col-6 text-right pt-2">
                                    <input type="text" class="form-control form-control-sm text-right font-large" :value="formatCurrency(states.payment_temp)"/>
                                </dd>

                                <dt class="col-6 font-weight-bold pt-2">Tiền thừa: </dt>
                                <dd class="col-6 text-right font-weight-bold text-danger pt-2">
                                    {{ formatCurrency(states.payment_return) }}
                                </dd>
                            </dl>

                            <div class="pt-4 mb-4">
                                <div class="text-dark d-flex mb-2">Thanh toán</div>
                                <ul class="list-unstyled option-buttons">
                                    <li id="card_payment_li">
                                        <input type="radio" id="cash" value="2" v-model="form.payment_method" name="payment-method" hidden>
                                        <label for="cash" class="btn btn-bordered px-4 mb-0">Tiền mặt</label>
                                    </li>
                                    <li id="card_payment_li">
                                        <input type="radio" id="transfer" disabled value="3" v-model="form.payment_method" name="payment-method" hidden>
                                        <label for="transfer" class="btn btn-bordered px-4 mb-0">Chuyển khoản</label>
                                    </li>
                                    <li id="cash_payment_li" v-if="form.order_type != '0'">
                                        <input type="radio" id="COD" value="0" v-model="form.payment_method" name="payment-method" hidden>
                                        <label for="COD" class="btn btn-bordered px-4 mb-0">COD</label>
                                    </li>
                                </ul>
                            </div>

                            <div v-if="form.amount != 0 && form.payment_method == '2'" class="pt-4 mb-4">
                                <div class="text-dark d-flex mb-2">Gợi ý</div>
                                <div class="d-flex gap-1">
                                    <button v-for="price in price_suggests" @click="onChangeAmount(price)" class="btn btn-bordered px-4 mb-0">{{ formatCurrency(price) }}</button>
                                </div>
                            </div>

                            <div class="pos-data-table">
                                <dl class="row">
                                    <dt class="col-6">
                                        <h5>In hóa đơn</h5>
                                    </dt>
                                    <dd class="col-6 text-right">
                                        <input type="checkbox" v-model="states.is_print">
                                    </dd>
                                </dl>
                            </div>

                            <div class="row mt-4 gy-2">
                                <div class="col-md-6">
                                    <button class="btn btn-outline-danger btn--danger btn-block" @click="resetPage">
                                        <i class="fa fa-times-circle "></i>
                                        Làm mới
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" @click="submitForm" class="btn btn-primary btn-block">
                                        <i class="fa fa-shopping-bag"></i>
                                        Hoàn thành
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <CustomerAddComponent @customer-add="getCustomer"/>
</template>

<script setup>
import { ref, reactive, onMounted, computed } from "vue";
import alertHelper from "~/Core/helpers/alertHelper";
import { formatCurrency } from "~/Core/helpers/currencyHelper";
import toastHelper from "~/Core/helpers/toastHelper";
import ProductSelectComponent from "~/Order/views/POS/ProductSelectComponent.vue";
import CustomerAddComponent from "~/Order/views/POS/CustomerAddComponent.vue";
import customerApi from "~/Customer/apis/customerApi";
import couponApi from "~/Coupon/apis/couponApi";
import orderApi from "~/Order/apis/orderApi";
import printApi from "~/Order/apis/printApi";
import { useRouter } from "vue-router";


const router = useRouter();

const form = reactive({
    user_id: "",
    order_type: "0",
    products: [],
    coupon_code: "",
    coupon_value: 0,
    payment_method: "2",
    total_price: 0,
    amount: 0,
    address2: "",
    note: ""
});

const price_suggests = reactive([]);

const customers = ref([]);

const states = reactive({
    payment_temp: 0,
    payment_return: 0,
    is_print: true,
});

function renderBtnSuggest(){
    onChangeAmount(0);
    price_suggests.splice(0, price_suggests.length);
    let currencies = [1000, 5000, 10000, 20000, 50000, 100000, 200000, 500000];
    currencies.forEach((currency, index) => {
        let roundCurrency = Math.ceil(form.amount / currency) * currency;
        if (price_suggests.includes(roundCurrency)) {
            return;
        }
        price_suggests.push(roundCurrency);
    });
}

function totalPriceProduct(product){
    return formatCurrency(product.quantity * product.price);
};

async function getCustomer(){
    try {
        const response = await customerApi.getCustomersPaginate();
        const data = response.data;
        const options = [{
            id: "",
            text: "Khách lẻ"
        }];
        data.data.forEach((customer) => {
            options.push({
                id: customer.id,
                text: customer.name,
            });
        });
        customers.value = options;
    } catch (error) {
        
    }
}

function resetPage(){
    router.go();
}

function onProductSelected(productNew){
    let flag = true;
    let price = 0;
    for(let i = 0; i < form.products.length; i++){
        const product = form.products[i];
        if(product.id == productNew.id){
            if(product.quantity >= productNew.available){
                toastHelper.error("Sản phẩm đã đạt tối đa", "top-left");
                return;
            }
            product.quantity += 1;
            flag = false;
        }
        price += product.price * product.quantity;
    }
    if(flag){
        form.products.unshift({...productNew});
        price += Number(productNew.price);
    }
    form.total_price = price;
    form.amount = price - form.coupon_value;
    renderBtnSuggest();
}

function onUpdateQuantityProduct(event, index){
    let price = 0;
    for(let i = 0; i < form.products.length; i++){
        const product = form.products[i];
        if(i == index){
            if(product.available < event.target.value){
                toastHelper.error("Sản phẩm đã đạt tối đa", "top-left");
                event.target.value = product.quantity = product.available;
                return
            }
            product.quantity = event.target.value;
        }
        price += product.price * product.quantity;
    }
    form.total_price = price;
    form.amount = price - form.coupon_value;
    renderBtnSuggest();
}

function onChangeAmount(price){
    states.payment_temp = price;
    states.payment_return = price - form.amount;
}

function onRemoveProduct(index){
    let price = 0;
    for(let i = 0; i < form.products.length; i++){
        const product = form.products[i];
        if(i == index){
            form.products.splice(index, 1);
            console.log(form.products);
        }
        else{
            price += product.price * product.quantity;
        }
    }
    form.total_price = price;
    form.amount = price - form.coupon_value;
    renderBtnSuggest();
}

async function checkCouponValue(){
    try {
        const payload = {
            code: form.coupon_code,
            amount: form.amount,
        }
        const response = await couponApi.checkCoupon(payload);
        const data = response.data;
        form.coupon_value = data.value;
    } catch (error) {
        
    }
}

async function submitForm(){
    if(!states.payment_temp){
        toastHelper.error("Khách hàng chưa thanh toán ?");
        return;
    }
    try {
        const response = await orderApi.addOrder(form);
        const data = response.data;
        if(states.is_print){
            await printOrder(data.order_code);
        }
    } catch (error) {
        const data = error.response.data;
        toastHelper.error(data.message);
    }
}

async function printOrder(code){
    try {
        const payload = {
            "page-type": "K80",
            "code": code,
        };
        const response = await printApi.printInvoice(payload);
        const data = response.data;

        const printWindow = window.open("", "In hóa đơn", 'width=1000,height=800');
        printWindow.document.write(data.invoice);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    } catch (error) {
    }
}

onMounted(async () => {
    await getCustomer();
});
</script>

<style scoped>
.option-buttons input:checked + label {
    background-color: #334257 !important;
    border-color: #334257 !important;
    color: #fff !important;
}

input.qty {
    width: 50px;
    height: 30px;
    text-align: center;
    padding: 2px;
}

input::-webkit-outer-spin-button, input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}

.font-large{
    font-size: large !important;
}
</style>