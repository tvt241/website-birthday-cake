<template>
    <PageHeaderTitleComponent header-title="Danh sách nhân viên">
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
                                    <th>Chức vụ</th>
                                    <th>Tên nhân viên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Kích hoạt</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(user, index) in users.data">
                                    <td class="vertical-middle">{{ index + 1 }}</td>
                                    <td>{{ user.role_name }}</td>
                                    <td>
                                        <div class="media align-items-center gap-3">
                                            <div class="avatar">
                                                <img :src="user.image ? user.image : IMG_DEFAULT"
                                                    class="rounded img-fit">
                                            </div>

                                            <div class="media-body">
                                                <a class="text-dark" href="#">
                                                    {{ user.name }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.phone }}</td>
                                    <td>
                                        <div>
                                            <label class="switcher">
                                                <input class="switcher_input" type="checkbox" :checked="user.is_active">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <router-link 
                                                class="btn btn-outline-info btn-sm edit square-btn"
                                                :to="{ name: 'employees.edit', params: { id: user.id }}"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </router-link>
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm delete square-btn"
                                                @click="onShowConfirm(user.id)">
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
import userApi from "~/User/apis/userApi";

const users = ref({});

const filter = reactive({
    page: 1
});

async function getUsersPaginate(page = 1) {
    filter.page = page;
    try {
        const response = await userApi.getUsersPaginate(filter);
        users.value = response.data;
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

async function deleteUser(id){
    try {
        await userApi.deleteUser(id);
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