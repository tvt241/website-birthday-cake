<template>
    <form action="" method="post">
        <div class="row g-2">
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="input-label">Mô tả</label>
                    <CkeditorBasicComponent v-model:content="form.desc" />
                </div> 
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-end gap-3 align-items-center">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { reactive } from "vue";
import CkeditorBasicComponent from "~/Core/components/Input/CkeditorBasicComponent.vue";
import settingApi from "~/Setting/api/settingApi";

const form = reactive({
    desc: ""
});


async function getConfig(){
    try {
        const response = await settingApi.getConfig("site", "refund_policy");
        form.desc = response.data[0].value;
    } catch (error) {
    }
}

onMounted(() => {
    getConfig();
});
</script>