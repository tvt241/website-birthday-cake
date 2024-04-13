<template>
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="app_id">App Id</label>
                <input type="text" placeholder="" class="form-control" id="app_id" v-model="form.app_id" required
                    autocomplete="off">
            </div>

            <div class="form-group">
                <label for="app_key">App Key</label>
                <input type="text" class="form-control" id="app_key" v-model="form.app_key" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="app_secret">App Secret</label>
                <input type="text" class="form-control" id="app_secret" v-model="form.app_secret" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="port">Port</label>
                <input type="text" class="form-control" id="port" v-model="form.port" required autocomplete="off">
            </div>

            <div class="form-group">
                <label for="scheme">Scheme</label>
                <input type="text" class="form-control" id="scheme" v-model="form.scheme" required autocomplete="off">
            </div>

            <div class="form-group">
                <label>App Cluster</label>
                <input type="text" placeholder="" class="form-control" v-model="form.app_cluster" name="app_cluster" value="" required
                    autocomplete="off">
            </div>

            <div class="btn--container">
                <button type="reset" class="btn btn-secondary">Đặt lại</button>
                <button type="submit" @click="save" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive } from 'vue';

const form = reactive({
    app_id: "",
    app_key: "",
    app_secret: "",
    port: "",
    scheme: "",
    app_cluster: "",
});

function save(){

}
</script>