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
                        <select id="customer" name="customer_id" v-model="form.customer_id" class="form-control">
                            <option value="">Khách lẻ</option>
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

                    <div v-if="form.order_type == '1'" class="form-group" id="home_delivery_section">
                        <div class="d-flex justify-content-between">
                            <label for="" class="font-weight-semibold fz-16 text-dark">
                                Thông tin giao hàng
                            </label>
                            <span class="edit-btn cursor-pointer" id="delivery_address" data-toggle="modal" data-target="#AddressModal">
                                <i class="mdi mdi-pencil"></i>
                            </span>
                        </div>
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
                                    <tr v-for="product in form.products">
                                        <td>
                                            <div class="media align-items-center gap-10">
                                                <img class="avatar avatar-sm" :src="product.image_url ?? IMG_DEFAULT">
                                                <div class="media-body">
                                                    <span class="text-hover-primary mb-0">
                                                        {{ product.name }}
                                                    </span>
                                                    <small class="d-block">{{ renderVariation(product.variation) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control qty"  :value="product.quantity" min="1">
                                        </td>
                                        <td>
                                            <div class="">
                                                {{ totalPriceProduct(product) }}
                                            </div>
                                        </td>
                                        <td class="justify-content-center gap-2">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger square-btn form-control">
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
                                <dd class="col-6 text-right">- {{ form.coupon_value }}</dd>

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
                                    <input type="text" class="form-control form-control-sm text-right font-large" :value="formatCurrency(form.amount)"/>
                                </dd>

                                <dt class="col-6 font-weight-bold pt-2">Tiền thừa: </dt>
                                <dd class="col-6 text-right font-weight-bold text-danger pt-2">
                                    {{ 0 }}
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
                                        <input type="radio" id="transfer" value="3" v-model="form.payment_method" name="payment-method" hidden>
                                        <label for="transfer" class="btn btn-bordered px-4 mb-0">Chuyển khoản</label>
                                    </li>
                                    <li id="cash_payment_li">
                                        <input type="radio" id="COD" value="0" v-model="form.payment_method" name="payment-method" hidden>
                                        <label for="COD" class="btn btn-bordered px-4 mb-0">COD</label>
                                    </li>
                                </ul>
                            </div>

                            <div v-if="form.amount != 0 && form.payment_method == '2'" class="pt-4 mb-4">
                                <div class="text-dark d-flex mb-2">Gợi ý</div>
                                <div class="d-flex gap-1">
                                    <button v-for="price in form.price_suggest" for="cash" class="btn btn-bordered px-4 mb-0">{{ formatCurrency(price) }}</button>
                                </div>
                            </div>

                            <div class="pos-data-table">
                                <dl class="row">
                                    <dt class="col-6">
                                        <h5>In hóa đơn</h5>
                                    </dt>
                                    <dd class="col-6 text-right">
                                        <input type="checkbox" v-model="form.is_print">
                                    </dd>
                                </dl>
                            </div>

                            <div class="row mt-4 gy-2">
                                <div class="col-md-6">
                                    <a href="#" class="btn btn-outline-danger btn--danger btn-block">
                                        <i class="fa fa-times-circle "></i>
                                        Hủy 
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-block">
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
</template>

<script setup>
import { ref, reactive, onMounted, computed } from "vue";
import alertHelper from "~/Core/helpers/alertHelper";
import { formatCurrency } from "~/Core/helpers/currencyHelper";
import inputHelper from "~/Core/helpers/inputHelper";
import toastHelper from "~/Core/helpers/toastHelper";
import ProductSelectComponent from "~/Order/views/POS/ProductSelectComponent.vue";

const form = reactive({
    customer_id: "",
    order_type: "0",
    products: [],
    coupon_code: "",
    coupon_value: 0,
    payment_method: "2",
    total_price: 0,
    price_suggest: [],
    is_print: true,
    amount: 0
});

const states = reactive({
    id: "",
    action: "add",
});

function onProductSelected(productNew){
    let flag = true;
    let price = 0;
    form.products.forEach((product) => {
        if(product.id == productNew.id){
            product.quantity += 1;
            flag = false;
        }
        price += product.price * product.quantity;
    });
    if(flag){
        form.products.unshift(productNew);
        price += Number(productNew.price);
    }
    form.total_price = price;
    form.amount = price - form.coupon_value;
    renderBtnSuggest();
}

function renderVariation(variations = []){
    let html = "";
    const max = variations.length - 2;
    variations.forEach((variation, index) => {
        html += variation.value;
        if(index == max){
            html += ", ";
        }
    })
    return html;
}

function renderBtnSuggest(){
    const price_suggest = [];
    let currencies = [1000, 5000, 10000, 20000, 50000, 100000, 200000, 500000];
    currencies.forEach((currency, index) => {
        let roundCurrency = Math.ceil(form.amount / currency) * currency;
        if (price_suggest.includes(roundCurrency)) {
            return;
        }
        price_suggest.push(roundCurrency);
        // html += `<button
        //             class="btn btn-outline-secondary m-1 p-1 text-center bg-white text-dark rounded-pill btn-select-money"
        //             style="width: 88px">
        //             ${formatNumberWithCommas(roundCurrency)}
        //         </button>`;
    });
    form.price_suggest = price_suggest;
}

function totalPriceProduct(product){
    return formatCurrency(product.quantity * product.price);
};

// function resetData() {
//     form.name = "";
//     form.slug = "";
//     form.description = "";
//     form.is_active = 1;
//     states.action = "add";
// }


// onMounted(async () => {
//     await getCategoriesPaginate();
// });
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