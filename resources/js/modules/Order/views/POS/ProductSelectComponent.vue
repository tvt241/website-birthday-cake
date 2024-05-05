<template>
    <div class="col-lg-6">
            <div class="card">
                <!-- POS Title -->
                <div class="pos-title">
                    <h4 class="mb-0">Sản phẩm</h4>
                </div>
                
                <div class="d-flex flex-wrap flex-md-nowrap justify-content-between gap-3 gap-xl-4 px-4 py-4">
                    <div class="w-100 mr-xl-2">
                        <select name="category" id="category" class="form-control" title="select category">
                            <option value="">Tất cả danh mục</option>
                            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                        </select>
                    </div>
                    <div class="w-100 ml-xl-2">
                        <div class="input-group border rounded">
                            <input
                                type="search"
                                @keyup="searchProductItem"
                                class="form-control border-0" 
                                placeholder="Tên sản phẩm"
                            >
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0" id="items">
                    <div class="pos-item-wrap justify-content-center">
                        <div v-for="product in products.data" class="pos-product-item card" @click="onProductSelected(product)">
                            <div class="pos-product-item_thumb">
                                <img :src="product.image_url ?? IMG_DEFAULT" class="img-fit">
                            </div>

                            <div class="pos-product-item_content">
                                <div class="pos-product-item_title">
                                    {{ product.name }}
                                </div>
                                <div class="">
                                    {{ renderVariation(product.variation) }}
                                </div>
                                <div class="pos-product-item_price">
                                    {{ formatCurrency(product.price) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 d-flex justify-content-end">
                    
                </div>
            </div>
        </div>
</template>

<script setup>
import { ref, onMounted, reactive, defineEmits } from 'vue';
import { formatCurrency } from '~/Core/helpers/currencyHelper';
import { IMG_DEFAULT } from '~/Core/helpers/imageHelper';
import productApi from '~/Product/apis/productApi';
import productCategoryApi from "~/Product/apis/productCategoryApi";

const products = ref({});
const categories = ref([]);

const emits = defineEmits(["productSelected"]);

const filter = reactive({
    page: 1,

});

async function getProductItemsPaginate(page = 1) {
    filter.page = page;
    try {
        const response = await productApi.getProductItemsPaginate(filter);
        products.value = response.data;
    } catch (error) {

    }
}

async function getCategories() {
    try {
        const response = await productCategoryApi.getCategories();
        categories.value = response.data;
    } catch (error) {
    }
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

function onProductSelected(product){
    const productFormat = product;
    productFormat.max_quantity = productFormat.quantity;
    productFormat.quantity = 1;
    emits("productSelected", productFormat);
}

function searchProductItem(e){
    if(e.key == "Enter"){

    }
}

function getProductByBarcode(barcode){
    
}

onMounted(() => { 
    getProductItemsPaginate();
    getCategories();
});
</script>