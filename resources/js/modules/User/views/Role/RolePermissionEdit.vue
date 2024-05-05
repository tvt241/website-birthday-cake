<template>
    <PageHeaderTitleComponent header-title="Vai trò và quyền">
        <button type="button"class="btn btn-primary text-nowrap">
            Danh sách vai trò
        </button>
    </PageHeaderTitleComponent>
    <div v-for="permission in permissions">
        <div class="card">
            <div class="card-body">
                <input type="checkbox" @click="handleActiveChild" :value="permission.name" :checked="handleCheckWithChildrenAll(permission.children)">
                <label class="text-left">{{ permission.title }}</label>
                <div class="row">
                    <div class="col-md-3" v-for="permission in permission.children">
                        <input :value="permission.name" @click="handleActiveParent" type="checkbox" :checked="temp.asset" id="">
                        <label for="">{{ permission.title }}</label>
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
import { useRoute } from 'vue-router'

const permissions = ref([]);

let temp = {};

const route = useRoute();

async function getPermissions() {
    try {
        const response = await roleApi.getPermissionsByRole(route.params.id);
        permissions.value = response.data;
    } catch (error) {
        console.log(error);
    }
}

function handleCheckChild(children, type){
    for (let index = 0; index < children.length; index++) {
        const element = children[index];
        if (element.type == type) {
            return element;
        }
    }
    return false;
}

function handleCheckWithChildrenAll(children = []){
    const count = children.filter(element => element.asset == true);
    if(count.length == children.length){
        return true;
    }
    return false;
}

function handleActiveChild(event){
    const tagTr = event.target.parentElement.parentElement;
    const tagTd = tagTr.querySelectorAll("input[type='checkbox']");
    const isChecked = event.target.checked;
    tagTd.forEach(element => {
        element.checked = isChecked;
    });
}

function handleActiveParent(event){
    const tagTr = event.target.parentElement.parentElement;
    const tagTd = tagTr.querySelectorAll("input[type='checkbox']");
    let count = 1;
    for (let index = 1; index < tagTd.length; index++) {
        if(tagTd[index].checked){
            count++;
        }
    }
    if(count !== tagTd.length){
        tagTd[0].checked = false;
        return;
    }
    tagTd[0].checked = true;
}

async function submitForm(){
    const permissions = [];
    const inputsChecked = document.querySelectorAll("input[type='checkbox']");
    inputsChecked.forEach((input) => {
        if(input.checked){
            permissions.push(input.value);
        }
    });
    try {
        const form = {
            permissions
        }
        const response = await roleApi.updatePermissionsByRole(route.params.id, form);
    } catch (error) {
        console.log(error);
    }
    
}

onMounted(() => {
    getPermissions();
});
</script>
