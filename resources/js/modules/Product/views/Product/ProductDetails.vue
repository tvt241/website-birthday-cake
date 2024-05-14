<template>
    <PageHeaderTitleComponent header-title="Chi tiết sản phẩm">
        <router-link :to="{ name: 'products' }" class="btn btn-primary text-nowrap">
            Danh sách sản phẩm
        </router-link>
    </PageHeaderTitleComponent>
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0 d-flex gap-2 align-items-center">
                Thông tin sản phẩm
            </h4>
        </div>
        <div class="card card-body h-100">
            <div class="row align-items-center">
                <div class="col-lg-6 product-details">
                    <p>Tên: 
                        <i class="h5">{{ product.name  }}</i>
                    </p>
                    <p>Giá: 
                        <i class="h5">{{ formatCurrency(product.min_price) + " - " + formatCurrency(product.max_price) }}</i>
                    </p>
                    <p>Còn lại/ Tổng: <i class="h5">{{ product.available + " / " + product.quantity }}</i></p>
                    <p>Đường dẫn: <i>{{ product.slug }}</i></p>
                    <p>Danh mục: <i>{{ product.category_name }}</i></p>
                    <p>Hiển thị: <i>{{ product.active_name }}</i></p>
                </div>
                <div class="col-lg-6">
                    <label class="font-weight-bold text-dark">Ảnh sản phẩm</label>
                    <div class="d-flex justify-content-center mt-4">
                        <div class="upload-file">
                            <div class="upload-file__img_drag upload-file__img">
                                <img width="200" :src="product.image" :on-error="IMG_DEFAULT" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0 d-flex gap-2 align-items-center">
                <i class="tio-canvas-text"></i>
                Chi tiết sản phẩm
            </h4>
        </div>
        <div class="card card-body h-100">
            <table class="table border text-center table-responsive-lg">
                <thead>
                    <template v-if="product.is_variation" >
                        <th class="text-center" style="width: 70px;">                         
                            Ảnh
                        </th>
                        <th v-for="variation in variations">
                            {{ variation }}
                        </th>
                    </template>
                    <th>Giá nhập</th>
                    <th>Giá bán</th>
                    <th>Còn lại</th>
                    <th>Kho</th>
                    <th>BarCode</th>
                </thead>
                <tbody>
                    <tr v-for="(item) in items">
                        <template v-if="product.is_variation">
                            <td>
                                <img width="50" :on-error="IMG_DEFAULT" :src="item.image" alt="">
                            </td>
                            <td class="text-center align-middle" v-for="key in item.key">
                                {{ key }}
                            </td>
                        </template>
                        <td>
                            {{ formatCurrency(item.price_import) }}
                        </td>
                        <td>
                            {{ formatCurrency(item.price) }}
                        </td>
                        <td>
                            {{ item.available }}
                        </td>
                        <td>
                            {{ item.quantity }}
                        </td>
                        <td class="barcode">
                            <BarCodeImage @click="showBarcode(item)" :value="item.barcode"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0 d-flex gap-2 align-items-center">
                <i class="tio-canvas-text"></i>
                Mô tả sản phẩm
            </h4>
        </div>
        <div class="card card-body h-100">
            <div class="row">
                <div class="col-lg-12">
                    <p>Mô tả ngắn</p>
                    <p class="text-dark">{{ product.desc_sort }}</p>
                </div>
                <div class="col-lg-12">
                    <p>Mô tả</p>
                    <p class="text-dark" v-html="product.desc"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-barcode" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-category-title">Barcode sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" v-if="states.barcode">
                    <div class="text-center">
                        <h4>{{ product.name }}</h4>
                        <p class="h5 my-2">{{ states.item.key.join(", ") }}</p>
                        <img :src="states.barcode"/>
                    </div>
                    <button class="btn btn-outline-info float-right">
                        In <i class="mdi mdi-printer"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <img style="display: none;" id="barcode"></img>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import { reactive, onMounted } from "vue";
import { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import productApi from "../../apis/productApi";
import { useRoute } from "vue-router";
import { formatCurrency } from "~/Core/helpers/currencyHelper";
import BarCodeImage from "~/Product/components/BarcodeImage.vue";
import printJS from "print-js";

const route = useRoute();

const states = reactive({
    barcode: null,
    item: {}
});

const items = reactive([]);

const variations = reactive([]);

const product = reactive({
    name: "",
    slug: "",
    active_name: 1,
    category_name: "",
    min_price: 0,
    max_price: 0,
    quantity: 0,
    available: 0,
    image: "",
    desc_sort: "",
    desc: "",
    is_variation: 0
});

async function getProduct(){
    try {
        const response = await productApi.getProduct(route.params.id);
        const data = response.data;
        product.name = data.name;
        product.slug = data.slug;
        product.desc_sort = data.desc_sort;
        product.min_price = data.min_price;
        product.max_price = data.max_price;
        product.quantity = data.quantity;
        product.available = data.available;
        product.category_name = data.category_name;
        product.active_name = data.active_name;
        product.desc = data.desc;
        product.image = data.image;
        renderProductItem(data.product_items);
    } catch (error) {
        console.log(error);
    }
}

function renderProductItem(productItems){
    productItems.forEach((item) => {
        const variation = item.variation;
        const productItem = {
            price_import: item.price_import,
            price: item.price,
            quantity: item.quantity,
            available: item.available,
            barcode: item.barcode,
            image: item.image,
            key: [variation.value]
        }
        variation.ancestors.forEach((variation_parent) => {
            productItem.key.unshift(variation_parent.value);
        });
        items.push(productItem);
    });
    if(productItems[0].variation.value == "default"){
        console.log("da");
        product.is_variation = 0;
        return;
    }
    const variation = productItems[0].variation;
    variations.push(variation.name);
    variation.ancestors.forEach(variation_parent => {
        variations.unshift(variation_parent.name);
    });
    
    product.is_variation = 1;
}


function showBarcode(item){
    const barcode = item.barcode;
    JsBarcode("#barcode", barcode, {
        format: "CODE128",
        displayValue: true,
    });
    states.barcode = document.getElementById("barcode").src;
    states.item = item;
    $("#modal-barcode").modal().show();
}
onMounted(async () => { 
    await getProduct();
});

</script>

<style>
    .product-details p{
        margin-bottom: 10px;
    }
</style>

<!-- <div class="d-flex gap-2 justify-content-center">
    <div class="d-inline-block">
        <span v-html="item.barcode"></span>
    </div>
    <button class="btn btn-outline-info btn-sm square-btn" @click="printJS({type: 'raw-html', printable: item.barcode})"><i class="mdi mdi-printer"></i></button>
</div> -->