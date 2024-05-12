<template>
    <PageHeaderTitleComponent header-title="Thêm đơn hàng">
        <router-link :to="{ name: 'posts' }" class="btn btn-primary text-nowrap">
            Danh sách đơn hàng
        </router-link>
    </PageHeaderTitleComponent>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";
import CkeditorBasicComponent from "~/Core/components/Input/CkeditorBasicComponent.vue";
import { ref, reactive, onMounted } from "vue";
import imageHelper, { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
import inputHelper from "~/Core/helpers/inputHelper";
import postCategoryApi from "~/Post/apis/postCategoryApi";
import postApi from "~/Post/apis/postApi";

const states = reactive({
    image: IMG_DEFAULT,
});

const errors = ref({});

const form = reactive({
    name: "",
    slug: "",
    category_id: "",
    desc_sort: "",
    desc: "",
    image: {},
    is_active: 1
});

async function previewImage(event) {
    try {
        const result = await imageHelper.previewImage(event);
        states.image = result.image_src;
        form.image = result.image;
    } catch (error) {
        console.log(error);
    }
}

function renderSlug(event) {
    form.slug = inputHelper.renderSlug(event);
}

const categories = ref([]);

async function getCategories() {
    try {
        const response = await postCategoryApi.getCategories();
        categories.value = response.data;
    } catch (error) {
    }
}

async function submitForm(){
    try {
        const response = await postApi.addPost(form);
        errors.value = {};
    } catch (error) {
        const data = error.response.data;
        errors.value = data.errors;
    }
}

onMounted(async () => { 
    await getCategories();
});
</script>