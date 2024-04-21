<template>
    <PageHeaderTitleComponent header-title="Danh sách sản phẩm">
        <router-link :to="{ name: 'products.create' }"  class="btn btn-primary text-nowrap">
            <i class="mdi mdi-plus"></i>
            Thêm
        </router-link>
    </PageHeaderTitleComponent>
    <div class="row g-2">
        <div class="col-12">
            <!-- Card -->
            <div class="card">
                <!-- Header -->
                <!-- <div class="card-top px-card pt-4">
                    <div class="row justify-content-between align-items-center gy-2">
                        <div class="col-lg-4">
                            <form action="http://localhost:2222/admin/product/list" method="GET">
                                <div class="input-group">
                                    <input id="" type="search" name="search" class="form-control"
                                        placeholder="Search by product name" aria-label="Search" value="" required
                                        autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-8">
                            <div class="d-flex gap-3 justify-content-end text-nowrap flex-wrap">
                                <div>
                                    <button type="button" class="btn btn-outline-primary" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="tio-download-to"></i>
                                        Export
                                        <i class="tio-chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a type="submit" class="dropdown-item d-flex align-items-center gap-2"
                                                href="http://localhost:2222/admin/product/excel-import">
                                                <img width="14"
                                                    src="http://localhost:2222/public/assets/admin/img/icons/excel.png"
                                                    alt="">
                                                Excel
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="py-4">
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 30%;">Tên sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Giá</th>
                                    <th>Kho</th>
                                    <th>Hiển thị</th>
                                    <th class="text-center">Khác</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(product, index) in products.data">
                                    <td class="vertical-middle">{{ index + 1 }}</td>
                                    <td>
                                        <div class="media align-items-center gap-3">
                                            <div class="avatar">
                                                <img :src="product.image ?? IMG_DEFAULT"
                                                    class="rounded img-fit">
                                            </div>

                                            <div class="media-body">
                                                <a class="text-dark" href="#">
                                                    {{ product.name }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ product.category_name }}</td>
                                    <td>
                                        {{ handleViewPrice(product.min_price, product.max_price) }}
                                    </td>
                                    <td>
                                        {{ product.quantity }}
                                    </td>
                                    <td>
                                        <div>
                                            <label class="switcher">
                                                <input class="switcher_input" @click="onUpdateActive(product.id)" type="checkbox" :checked="product.is_active">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <router-link 
                                                class="btn btn-outline-info btn-sm edit square-btn"
                                                :to="{ name: 'products.edit', params: { id: product.id }}"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </router-link>
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm delete square-btn"
                                                @click="onShowConfirm(product.id)">
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
import { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import productApi from "~/Product/apis/productApi";
import { formatCurrency } from "~/Core/helpers/currencyHelper";

const products = ref([]);

const filter = reactive({
    page: 1
});

async function getProductsPaginate(page = 1) {
    filter.page = page;
    try {
        const response = await productApi.getProductsPaginate(filter);
        products.value = response.data;
    } catch (error) {

    }
}

function onShowConfirm(id) {
    alertHelper.confirmDelete()
        .then((result) => {
            if (result.isConfirmed) {
                deleteProduct(id);
            }
        })
}

async function deleteProduct(id){
    try {
        await productApi.deleteProduct(id);
        getProductsPaginate();
    } catch (error) {

    }
}

async function onUpdateActive(id){
    try {
        await productApi.changeActiveProduct(id);
        getProductsPaginate();
    } catch (error) {

    }
}

function handleViewPrice(min, max){
    if(min && max){
        const minFormat = formatCurrency(min);
        if(minFormat){
            return formatCurrency(max);
        }
        return `${ minFormat } - ${ formatCurrency(max) }`
    }
    return "Chưa có thông tin"
}


onMounted(() => { 
    getProductsPaginate();
});

</script>

<style>
td{
    vertical-align: middle !important;
}
</style>