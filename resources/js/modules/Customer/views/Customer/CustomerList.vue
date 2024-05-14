<template>
    <PageHeaderTitleComponent header-title="Danh sách khách hàng">
        <router-link :to="{ name: 'employees.create' }"  class="btn btn-primary text-nowrap">
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
                                    <th>Tên đăng nhập</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Mạng xã hội</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(customer, index) in customers.data">
                                    <td class="vertical-middle">{{ index + 1 }}</td>
                                    <td>
                                        <div class="media align-items-center gap-3">
                                            <div class="avatar">
                                                <img :src="customer.image ? customer.image : IMG_DEFAULT"
                                                    class="rounded img-fit">
                                            </div>

                                            <div class="media-body">
                                                <a class="text-dark" href="#">
                                                    {{ customer.username }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ customer.name }}</td>
                                    <td>{{ customer.email }}</td>
                                    <td>{{ customer.phone }}</td>
                                    <td>{{ customer.social }}</td>
                                    <td>
                                        <select class="form-control" v-model="customer.is_active" @change="confirmChange(customer.id, $event)">
                                            <option value="1">Kích hoạt</option>
                                            <option value="0">Chưa kích hoạt</option>
                                            <option value="2">Khóa</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <router-link 
                                                class="btn btn-outline-info btn-sm square-btn"
                                                :to="{ name: 'customers.details', params: { id: customer.id }}"
                                            >
                                                <i class="mdi mdi-eye"></i>
                                            </router-link>
                                            <router-link 
                                                class="btn btn-outline-warning btn-sm square-btn"
                                                :to="{ name: 'customers.edit', params: { id: customer.id }}"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </router-link>
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm square-btn"
                                                @click="onShowConfirm(customer.id)">
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
import { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import alertHelper from "~/Core/helpers/alertHelper";
import customerApi from "~/Customer/apis/customerApi";

const customers = ref({});

const filter = reactive({
    page: 1
});

async function getUsersPaginate(page = 1) {
    filter.page = page;
    try {
        const response = await customerApi.getCustomersPaginate(filter);
        customers.value = response.data;
    } catch (error) {

    }
}

function onShowConfirm(id) {
    alertHelper.confirmDelete()
        .then((result) => {
            if (result.isConfirmed) {
                deleteUser(id);
            }
        })
}

function confirmChange(id, event){
    alertHelper.confirmDelete()
        .then((result) => {
            if (result.isConfirmed) {
                const is_active = event.target.value
                changeActiveCustomer(id, is_active);
            }
        })
}

async function deleteUser(id){
    try {
        await customerApi.deleteUser(id);
        getUsersPaginate();
    } catch (error) {

    }
}

async function changeActiveCustomer(id, is_active){
    try {
        await customerApi.changeActiveCustomer(id, is_active);
        getUsersPaginate();
    } catch (error) {

    }
}

onMounted(async () => { 
   await getUsersPaginate();
});

</script>

<style>
td{
    vertical-align: middle !important;
}
</style>