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
                <div class="col-md-12">
                    <div class="form-inline gap-2 mb-2">
                        <input type="text" class="form-control" placeholder="Tên phân loại" v-model="variation_name">
                        <button type="button" class="btn btn-primary" @click="addVariation">Thêm phân loại</button>
                    </div>
                    <draggable tag="ul" :list="variations" class="list-group" item-key="variations">
                        <template #item="{ element, index }">
                            <li class="list-group-item">
                                <i class="mdi mdi-menu mdi-24px handle"></i>
                                <input type="text" class="form-control input-variation ml-2 col-lg-3"
                                    v-model="element.name" placeholder="Tên phân loại" />
                                <input type="text" class="form-control input-variation ml-2 col-lg-8"
                                    :value="element.options.join(',')" placeholder="Các phân loại"
                                    @keyup="handleUpdateOption($event, index)" />
                                <i class="mdi mdi-close mdi-24px close" @click="removeVariation(index)"></i>
                            </li>
                        </template>
                    </draggable>
                    <div class="my-3">
                        <table class="table border text-center table-responsive-lg">
                            <thead>
                                <th class="text-center" style="width: 70px;">                                    
                                    <span>
                                        Ảnh
                                    </span>
                                    <span class="float-right" title="Áp dụng giá trị đầu tiền cho tất cả">
                                        <i class="mdi mdi-arrow-down"></i>
                                    </span>
                                </th>
                                <th v-for="variation in variations">
                                    {{ variation.name }}
                                </th>
                                <th>
                                    <span>
                                        Giá nhập
                                        <span class="text-danger">*</span>
                                    </span>
                                    <span class="float-right" title="Áp dụng giá trị đầu tiền cho tất cả">
                                        <i class="mdi mdi-arrow-down"></i>
                                    </span>
                                </th>
                                <th>
                                    <span>
                                        Giá bán
                                        <span class="text-danger">*</span>
                                    </span>
                                    <span class="float-right" title="Áp dụng giá trị đầu tiền cho tất cả">
                                        <i class="mdi mdi-arrow-down"></i>
                                    </span>
                                </th>
                                <th>                                    
                                    <span>
                                        Số lượng
                                        <span class="text-danger">*</span>
                                    </span>
                                    <span class="float-right" title="Áp dụng giá trị đầu tiền cho tất cả">
                                        <i class="mdi mdi-arrow-down"></i>
                                    </span>
                                </th>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in items">
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div class="upload-file">
                                                <input type="file" name="image"
                                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                                    class="upload-file__input"
                                                    @change="previewImage($event, index)"
                                                >
                                                <div class="upload-file__img_drag upload-file__img">
                                                    <img width="50" :src="item.image_src"
                                                         alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle" v-for="key in item.key">
                                        {{ key }}
                                    </td>
                                    <td>
                                        <input class="form-control p-2 text-right" v-model="item.price_import" @keyup="emitVariationChange" type="text" placeholder="Giá nhập">
                                    </td>
                                    <td>
                                        <input class="form-control p-2 text-right" v-model="item.price" @keyup="emitVariationChange" type="text" placeholder="Giá bán">
                                    </td>
                                    <td style="width: 120px;">
                                        <input class="form-control p-2 text-right" v-model="item.quantity" @keyup="emitVariationChange" type="text" placeholder="Số lượng" >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, defineEmits, defineProps, onMounted } from 'vue';
import draggable from 'vuedraggable';
import imageHelper, { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import debounce from 'lodash/debounce';

const emit = defineEmits(['variationsChange']);

const props = defineProps({
    variations: {
        type: Array,
        default: []
    },
    items: {
        type: Array,
        default: []
    }
});

const items = reactive([]);

const variation_name = ref("");

const variations = reactive(props.variations);

function addVariation() {
    variations.push({
        name: variation_name.value,
        options: []
    });
    variation_name.value = "";
}

function removeVariation(index) {
    variations.splice(index);
    items.splice(0, items.length);
    updateVariations();
}

const handleUpdateOption = (event, index) => {
    const options = event.target.value.split(",");
    variations[index].options = options;
    items.splice(0, items.length);
    updateVariations();
}

function updateVariations(currentIndex = 0, currentArray = []) {
    if (currentIndex === variations.length) {
        items.push({
            key: currentArray,
            image: {},
            image_src: IMG_DEFAULT,
            price_import: 0,
            price: 0,
            quantity: 0,
        });
        emitVariationChange();
        return;
    }
    const currentVariation = variations[currentIndex];
    for (let i = 0; i < currentVariation.options.length; i++) {
        const option = currentVariation.options[i];
        const newArray = [...currentArray, option];
        updateVariations(currentIndex + 1, newArray);
    }
}

const emitVariationChange = debounce(() => {
    const simpleData = items.map((variation) => {
        const temp = {...variation};
        delete temp.image_src;
        delete temp.key;
        return temp;
    })
    emit("variationsChange", simpleData, variations);
}, 1000);

async function previewImage(event, index) {
    try {
        const result = await imageHelper.previewImage(event);
        items[index].image = result.image;
        items[index].image_src = result.image_src;
        emitVariationChange();
    } catch (error) {
        console.log(error);
    }
}

onMounted(() => {
    if(props.variations.length){
        updateVariations();
        props.items.forEach((item, index) => {
            items[index].price_import = item.price_import;
            items[index].price = item.price;
            items[index].quantity = item.quantity;
        });
        emitVariationChange();
    }
})
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

</style>