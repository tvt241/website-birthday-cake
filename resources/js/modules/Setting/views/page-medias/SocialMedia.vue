<template>
    <PageHeaderTitleComponent header-title="Thiết lập mạng xã hội">
    </PageHeaderTitleComponent>
    <form action="POST">
        <div class="card mt-3">
            <div class="card card-body h-100">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="input-label">Mạng xã hội</label>
                            <select name="" id="" class="form-control">
                                <option value="">-- Chọn --</option>
                                <option v-for="social in socials" :value="social.key">{{ social.key }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="input-label">Link</label>
                            <input type="text" class="form-control" placeholder="Nhập link">
                        </div>
                    </div>
                    <div class="col-md-12 d-flex gap-3 justify-content-end">
                        <button type="reset" class="btn btn-secondary">Đặt lại</button>
                        <button type="button" class="btn btn-primary" @click="submitForm">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>        
    </form>

    <div class="card mt-2">
        <table class="table text-center">
            <thead>
                <th>#</th>
                <th>Tên</th>
                <th style="width: 40%;">Link</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </thead>
            <tbody>
                <tr v-for="(social, index) in socials">
                    <td>{{ index + 1 }}</td>
                    <td>{{ social.key }}</td>
                    <td class="text-left">{{ social.value }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <label class="switcher">
                            <input type="checkbox" @click="changeActive(social.key)" class="switcher_input" checked>
                            <span class="switcher_control"></span>
                        </label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <button class="btn btn-sm btn-outline-danger square-btn" @click="onShowConfirm(social.key)">
                                <i class="mdi mdi-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { reactive, onMounted } from "vue";
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";

import settingApi from "~/Setting/api/settingApi";

const socials = reactive([]);

async function getConfig(key = null){
    try {
        const response = await settingApi.getConfig("social_media", key);
        response.data.forEach(config => {
            socials.push({
                key: config.key,
                value: config.value,
            });
        });
    } catch (error) {
    }
}

function onShowConfirm(key){
    
}

onMounted(() => {
    getConfig();
});

</script>