<template>
    <div :class="classDiv ?? 'form-group'">
        <label for="mail_password">{{ $t("label.mail_password") }}</label>
        <div class="input-group input-group-merge">
            <input 
                :type="showPass.type" 
                v-model="passwordValue"
                class="form-control"
                id="mail_password"
                required
                autocomplete="off"
            >
            <div id="changePassTarget" class="input-group-append">
                <a class="input-group-text" href="javascript:">
                    <i id="changePassIcon" @click="toggleShowPass"
                        class="mdi"
                        :class="showPass.isActive ? 'mdi-eye' : 'mdi-eye-off'"></i>
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive } from "vue";

const props = defineProps(['classDiv']);

const passwordValue = defineModel("passwordValue");

const showPass = reactive({
    isActive: false,
    type: "password"
})

function toggleShowPass() {
    const isShow = showPass.isActive == true ? false : true;
    showPass.isActive = isShow;
    showPass.type = isShow ? "text" : "password";
}

</script>