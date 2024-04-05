<template>
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0 d-flex gap-2 align-items-center">
                <i class="tio-canvas-text"></i>
                Thông tin chi tiết
            </h4>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="input-label">
                            Giá nhập
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="input-label">
                            Giá bán
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="input-label">
                            Số lượng
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="input-label">Kiểu giảm giá</label>
                        <select class="form-control">
                            <option>-- Không giảm giá --</option>
                            <option>Tiền mặt</option>
                            <option value="1">Phần trăm</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="input-label">Giá trị giảm giá</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="input-label">Số lượng sản phẩm giảm giá</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineModel } from 'vue';
import draggable from 'vuedraggable';

const formVariations = defineModel('formVariations');

</script>

<style scoped>
.handle {
    float: left;
    padding-top: 8px;
    padding-bottom: 8px;
}

.close {
    float: right;
    padding-top: 8px;
    padding-bottom: 8px;
}

.input-variation {
    display: inline-block;
    /* width: 50%; */
}

.input-quantity {
    width: 100px;
}
</style>