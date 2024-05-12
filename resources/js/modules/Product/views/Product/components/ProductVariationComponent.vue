<template>
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0 d-flex gap-2 align-items-center">
                <i class="tio-canvas-text"></i>
                Thông tin chi tiết
            </h4>
        </div>
        <div class="card-body pb-0">
            <div class="row" v-if="items.length">
                <div class="col-md-6" >
                    <div class="form-group">
                        <label class="input-label">
                            Giá nhập
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                            v-model="items[0].price_import" 
                            @change="onUpdateVariation" 
                            class="form-control"
                            :class="{ 'is-invalid': errors['items.0.price_import'] }"
                        >
                        <span v-if="errors['items.0.price_import']" class="invalid-feedback">
                            {{ errors['items.0.price_import'][0] }}
                        </span>
                    </div>
                    <div class="form-group">
                        <label class="input-label">
                            Giá bán
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                            v-model="items[0].price" 
                            class="form-control"
                            :class="{ 'is-invalid': errors['items.0.price'] }"
                        >
                        <span v-if="errors['items.0.price']" class="invalid-feedback">
                            {{ errors['items.0.price'][0] }}
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="input-label">
                            Số lượng
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                            v-model="items[0].quantity" 
                            class="form-control"                            
                            :class="{ 'is-invalid': errors['items.0.quantity'] }"
                        >
                        <span v-if="errors['items.0.quantity']" class="invalid-feedback">
                            {{ errors['items.0.quantity'][0] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, defineEmits, defineProps, watch } from 'vue';
import debounce from 'lodash/debounce';
import { onMounted } from 'vue';

const emits = defineEmits(["variationsChange"]);

const props = defineProps({
    errors: {
        type: Object,
        default: {}
    },
    items: {
        type: Array,
        default: [{
            price_import: 0,
            price: 0,
            quantity: 0
        }]
    }
});

const items = reactive(props.items);

const variations = [{
    name: "default",
    options: [
        "default"
    ]
}];

const onUpdateVariation = debounce(() => {
    emits("variationsChange", items, variations, 0);
}, 1000);

onMounted(() => {
    emits("variationsChange", items, variations, 0);
});
</script>