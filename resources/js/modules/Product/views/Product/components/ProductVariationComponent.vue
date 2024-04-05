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
                    <draggable tag="ul" :list="variations" class="list-group">
                        <template #item="{ element, index }">
                            <li class="list-group-item">
                                <i class="mdi mdi-menu mdi-24px handle"></i>
                                <input type="text" class="form-control input-variation ml-2 col-lg-3"
                                    v-model="element.name" placeholder="Tên phân loại" />
                                <input type="text" class="form-control input-variation ml-2 col-lg-8"
                                    v-model="element.options" placeholder="Các phân loại"
                                    @keyup="handleUpdateOption($event, index)" />
                                <i class="mdi mdi-close mdi-24px close" @click="removeVariation(index)"></i>
                            </li>
                        </template>
                    </draggable>
                    <div class="my-3">
                        <div class="mb-2">
                            <span>Chú thích:</span>
                            <span class="text-danger"> SL - Số lượng, GG - Giảm giá, KH - Kích hoạt</span>
                        </div>
                        <table class="table border text-center table-responsive">
                            <thead>
                                <th class="text-center" style="width: 70px;">Ảnh</th>
                                <th v-for="variation in variations">
                                    {{ variation.name }}
                                </th>
                                <th>
                                    Giá nhập
                                    <span class="text-danger">*</span>
                                </th>
                                <th>
                                    Giá bán
                                    <span class="text-danger">*</span>
                                </th>
                                <th>
                                    SL
                                    <span class="text-danger">*</span>
                                </th>
                                <th>
                                    Giảm giá
                                </th>
                                <th>
                                    Giá trị GG
                                </th>
                                <th>
                                    SL GG
                                </th>
                                <th>
                                    Hạn GG
                                </th>
                                <th>
                                    KH
                                </th>
                            </thead>
                            <tbody>
                                <tr v-for="(variation, index) in formVariations">
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div class="upload-file">
                                                <input type="file" name="image"
                                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                                    class="upload-file__input"
                                                    @change="previewImage($event, index)"
                                                >
                                                <div class="upload-file__img_drag upload-file__img">
                                                    <img width="50" :src="variation.image_src"
                                                         alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle" v-for="key in variation.key">
                                        {{ key }}
                                    </td>
                                    <td>
                                        <input class="form-control p-2" type="text">
                                    </td>
                                    <td>
                                        <input class="form-control p-2" type="text">
                                    </td>
                                    <td class="text-end input-quantity">
                                        <input class="form-control p-2" type="text">
                                    </td>
                                    <td class="input-quantity">
                                        <select class="form-control p-2">
                                            <option>---</option>
                                            <option value="0">VND</option>
                                            <option value="1">%</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input class="form-control p-2" type="text">
                                    </td>
                                    <td class="input-quantity">
                                        <input class="form-control p-2" type="text">
                                    </td>
                                    <td>
                                        <input class="form-control p-2" type="datetime-local">
                                    </td>
                                    <td class="align-middle">
                                        <input class="align-middle" type="checkbox" checked>
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
import { ref } from 'vue';
import { defineEmits, reactive } from 'vue';
import draggable from 'vuedraggable';
import { IMG_DEFAULT } from "~/Core/helpers/imageHelper";

const formVariations = reactive([]);

const variation_name = ref("");

const emit = defineEmits(['variationsChange'])

function addVariation() {
    variations.push({
        name: variation_name.value,
        options: []
    })
}

const variations = reactive([
    {
        name: "size",
        options: [
            "xxl",
            "xl",
            "m",
            "l"
        ]
    },
    {
        name: "color",
        options: [
            "red",
            "blue",
            "black",
            "pink"
        ]
    },
]);

function removeVariation(index) {
    variations.splice(index);
    formVariations.splice(0, formVariations.length);
    updateVariations();
}

let timeOut = null;

function handleUpdateOption(event, index) {
    const options = event.target.value.split(",");
    variations[index].options = options.map(option => option.trim());
    formVariations.splice(0, formVariations.length);
    clearTimeout(timeOut);
    timeOut = setTimeout(() => {
        updateVariations();
    }, 1000);
}

function updateVariations(currentIndex = 0, currentArray = []) {
    if (currentIndex === variations.length) {
        formVariations.push({
            key: currentArray,
            image: {},
            image_src: IMG_DEFAULT,
            import_price: 0,
            price: 0,
            quantity: 0,
            is_sell: false
        });
        clearTimeout(timeOut);
        timeOut = setTimeout(() => {
            emit("variationsChange", formVariations);
        }, 1000);
        return;
    }
    const currentVariation = variations[currentIndex];
    for (let i = 0; i < currentVariation.options.length; i++) {
        const option = currentVariation.options[i];
        const newArray = [...currentArray, option];
        updateVariations(currentIndex + 1, newArray);
    }
}

function previewImage(event, index) {
    if (event.target.files && event.target.files[0]) {
        formVariations[index].image = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            formVariations[index].image_src = e.target.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
}

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