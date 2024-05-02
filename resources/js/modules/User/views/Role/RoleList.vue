<template>
    <PageHeaderTitleComponent header-title="Vai trò và quyền">
        <button type="button" data-target="#modal-category" data-toggle="modal" class="btn btn-primary text-nowrap"
            @click="resetData">
            <i class="mdi mdi-plus"></i>
            Thêm
        </button>
    </PageHeaderTitleComponent>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="">
                    <div>
                        <ul>
                            <li v-for="role in rolesPaginate" class="d-flex justify-content-between p-2 border-bottom">
                                <span class="capitalize text-start text-dark">
                                    {{ role.name }} 
                                    <div class="text-secondary">
                                        ({{ role.members }}) người
                                    </div>
                                </span>
                                <div class="d-flex justify-content-start align-items-center gap-2">
                                    <button class="btn btn-sm btn-outline-info square-btn">
                                        <i class="mdi mdi-key"></i>
                                    </button>
                                    <router-link 
                                        :to="{ name: 'roles.details', params: { id: role.id} }"
                                        class="btn btn-sm btn-outline-info square-btn"
                                    >
                                        <i class="mdi mdi-key"></i>
                                    </router-link>
                                    <button
                                        class="btn btn-sm btn-outline-warning square-btn" 
                                        type="button" 
                                        data-target="#modal-role" 
                                        data-toggle="modal"
                                        @click="getRole(role.id)"
                                    >
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger square-btn">
                                        <i class="mdi mdi-trash-can"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-role" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-role-title">{{ modelContent[states.action].title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="role-name">
                                Tên vai trò
                                <small class="text-danger">*</small>
                            </label>
                            <input type="text" class="form-control" v-model="form.name"
                                id="role-name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <div class="gap-2 d-flex">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Đóng
                        </button>
                        <button type="button" class="btn btn-primary" @click="handleModelAction">
                            {{  modelContent[states.action].button }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import alertHelper from "~/Core/helpers/alertHelper";
import toastHelper from "~/Core/helpers/toastHelper";
import roleApi from "~/User/apis/roleApi";
// config
const states = reactive({
    id: "",
    action: "add"
});

const modelContent = {
    add: {
        title: "Thêm vai trò",
        button: "Lưu"
    },
    edit: {
        title: "Chỉnh sửa vai trò",
        button: "Cập nhật"
    },

};

const filter = reactive({
    page: 1
});
// list
const rolesPaginate = ref({});

async function getRoles() {
    filter.page = page;
    try {
        const response = await roleApi.getRoles();
        rolesPaginate.value = response.data;
    } catch (error) {
    }
}
// get
async function getRole(id) {
    states.id = id;
    states.action = "edit";
    try {
        const response = await roleApi.getRole(id);
        form.name = response.data.name;
    } catch (error) {
    }
}
// create
const formDataDefault = {
    name: ""
};

const form = reactive(formDataDefault);

async function handleModelAction() {
    try {
        if (states.action == "add") {
            await roleApi.addRole(form);
        } else {
            await roleApi.updateRole(states.id, form);
        }
        getRoles();
    } catch (error) {
    }
}
// delete
async function deleteRole(id) {
    states.id = id;
    try {
        await roleApi.deleteRole(states.id);
        getRoles();
    } catch (error) {
    }
}

function onShowConfirm(id) {
    alertHelper.confirmDelete()
        .then((result) => {
            if (result.isConfirmed) {
                deleteRole(id);
            }
        })
}

function resetData() {
    Object.assign(form, formDataDefault);
    states.action = "add";
}

onMounted(async () => {
    await getRoles();
});
</script>
