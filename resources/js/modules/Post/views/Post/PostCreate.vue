<template>
    <PageHeaderTitleComponent :header-title="$t('label.products.create')">
    </PageHeaderTitleComponent>
    <div class="col-12">
        <form>
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="mb-0 d-flex gap-2 align-items-center">
                        <i class="tio-canvas-text"></i>
                        Thông tin sản phẩm
                    </h4>
                </div>
                <div class="card card-body h-100">
                    <ul class="nav nav-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link lang_link active" href="#" id="en-link">Việt Nam(Vi)</a>
                        </li>
                    </ul>
                    <div class="lang_form" id="en-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="input-label">Tên</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="input-label">Mô tả ngắn</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="input-label">Mô tả</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="mb-0 d-flex gap-2 align-items-center">
                        <i class="tio-canvas-text"></i>
                        Thông tin chung
                    </h4>
                </div>
                <div class="card card-body h-100">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Danh mục
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="category_id" class="form-control">
                                    <option>---Select---</option>
                                    <option value="1">Test category</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlSelect1">
                                    Phân loại
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="" class="form-control">
                                    <option>Không phân loại</option>
                                    <option value="1">Phân loại</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Ảnh hiển thị trang chính</label>
                                <small class="text-danger">*</small>
                                <div class="d-flex justify-content-center mt-4">
                                    <div class="upload-file">
                                        <input type="file" name="image"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                            class="upload-file__input">
                                        <div class="upload-file__img_drag upload-file__img">
                                            <img width="176" :src="imgSrcPreview" @change="previewImage($event)" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                <input type="text" class="form-control" placeholder="Tên phân loại">
                                <button type="button" class="btn btn-primary">Thêm phân loại</button>
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
                                        <i class="mdi mdi-close mdi-24px close" @click="removeAt(index)"></i>
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
                                        <tr v-for="variation in form.variations">
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="upload-file">
                                                        <input type="file" name="image"
                                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                                            class="upload-file__input">
                                                        <div class="upload-file__img_drag upload-file__img">
                                                            <img width="50" :src="imgSrcPreview"
                                                                @change="previewImage($event)" alt="">
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
            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="reset" class="btn btn-secondary">{{ $t("button.reset") }}</button>
                <button type="submit" class="btn btn-primary">{{ $t("button.save") }}</button>
            </div>
        </form>
    </div>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import draggable from 'vuedraggable'
import { ref, reactive } from "vue";
import { IMG_DEFAULT } from "~/Core/config/env";

const variations = reactive([
    {
        id: 0,
        name: "size",
        options: [
            "xxl",
            "xl",
            "m",
            "l"
        ]
    },
    {
        id: 1,
        name: "color",
        options: [
            "red",
            "blue",
            "black",
            "pink"
        ]
    },
]);

function handleUpdateOption(event, index) {
    const options = event.target.value.split(",");
    variations[index].options = options.map(option => option.trim());
    form.value.variations = [];
    updateVariations();
    console.log(form.value);
}

const form = ref({
    name: "",
    desc: "",
    categories: [],
    image: {},
    is_variation: true,
    variations: []
});

function updateVariations(currentIndex = 0, currentArray = []) {
    if (currentIndex === variations.length) {
        form.value.variations.push({
            key: currentArray
        });
        return;
    }
    const currentVariation = variations[currentIndex];
    for (let i = 0; i < currentVariation.options.length; i++) {
        const option = currentVariation.options[i];
        const newArray = [...currentArray, option];
        updateVariations(currentIndex + 1, newArray);
    }
}

const imgSrcPreview = ref(IMG_DEFAULT);

function previewImage(event) {
    if (event.target.files && event.target.files[0]) {
        form.image = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            imgSrcPreview.value = e.target.result;
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

.input-quantity{
    width: 100px;
}
</style>

<!-- <div class="form-group">
    <div class="input-label justify-content-between">
        <label for="">Đơn vị tính</label>
        <button class="btn btn-sm square-btn btn-primary">
            <i class="mdi mdi-plus"></i>
        </button>
    </div>
    <div class="form-inline mt-1 justify-content-between">
        <label for="" class="col-6 pl-0 justify-content-start">Tên : Số lượng quy đổi</label>
        <input type="text" class="form-control col-2 p-1">
        :
        <input type="text" class="form-control col-2 p-1">
        <button class="btn btn-sm square-btn btn-info text-white">
            <i class="mdi mdi-minus"></i>
        </button>
    </div>
</div> -->