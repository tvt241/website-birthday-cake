<template>
     <div class="modal fade" id="add-customer" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-category-title">Thêm khách hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="customer-name">
                                Tên khách hàng
                                <small class="text-danger">*</small>
                            </label>
                            <input type="text" v-model="form.name" class="form-control"
                                id="customer-name">
                        </div>
                        <div class="form-group">
                            <label for="customer-phone">
                                Số điện thoại
                                <small class="text-danger">*</small>
                            </label>
                            <input type="text" v-model="form.phone" class="form-control"
                                id="customer-phone">
                        </div>
                        <div class="form-group">
                            <label for="customer-email">
                                Email
                            </label>
                            <input type="" class="form-control" v-model="form.email" id="customer-email">
                        </div>
                        <div class="form-group">
                            <label for="customer-email">
                                Mật khẩu
                            </label>
                            <input type="" class="form-control" v-model="form.password" id="customer-email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer gap-2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Đóng
                    </button>
                    <button type="button" class="btn btn-primary" @click="onAddCustomer">
                        Thêm
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, defineEmits } from 'vue';
import customerApi from '~/Customer/apis/customerApi';

const form = reactive({
    name: "",
    phone: "",
    email: "",
    password: "",
})

const emits = defineEmits(["customerAdd"]);

async function onAddCustomer(){
    try {
        const response = customerApi.addCustomer(form);
        emits("customerAdd");
    } catch (error) {
        
    }
}
</script>