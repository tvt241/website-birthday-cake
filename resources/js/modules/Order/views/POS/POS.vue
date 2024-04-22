<template>
    <div class="row">
        <ProductSelectComponent>

        </ProductSelectComponent>
        <OrderComponent>

        </OrderComponent>
    </div>
</template>

<script setup>
import alertHelper from "~/Core/helpers/alertHelper";

import { ref, reactive, onMounted } from "vue";
import postCategoryApi from "~/Post/apis/postCategoryApi";
import inputHelper from "~/Core/helpers/inputHelper";
import ProductSelectComponent from "~/Order/views/POS/ProductSelectComponent.vue";
import OrderComponent from "~/Order/views/POS/OrderComponent.vue";

const states = reactive({
    id: "",
    action: "add",
});

const modelContent = {
    add: {
        title: "Thêm danh mục tin tức",
        button: "Lưu"
    },
    edit: {
        title: "Chỉnh sửa danh mục tin tức",
        button: "Cập nhật"
    },

};

const categories = ref({});

const form = reactive({
    name: "",
    slug: "",
    description: "",
    is_active: 1,
});

const filter = reactive({
    page: 1,
});

function resetData() {
    form.name = "";
    form.slug = "";
    form.description = "";
    form.is_active = 1;
    states.action = "add";
}


async function getCategoriesPaginate(page = 1) {
    filter.page = page;
    try {
        const response = await postCategoryApi.getCategoriesPaginate(filter);
        categories.value = response.data;
    } catch (error) {
    }
}

async function getCategory(id) {
    states.id = id;
    states.action = "edit";
    try {
        const response = await postCategoryApi.getCategory(states.id);
        const data = response.data;
        form.name = data.name;
        form.slug = data.slug;
        form.description = data.description;
        form.is_active = data.is_active;
    } catch (error) {
    }
}

async function handleModelAction() {
    try {
        if (states.action == "add") {
            await postCategoryApi.addCategory(form);
        } else {
            await postCategoryApi.updateCategory(states.id, form);
        }
        getCategoriesPaginate();
    } catch (error) {
    }
}

async function deleteCategory(id) {
    try {
        const response = await postCategoryApi.deleteCategory(id);
        getCategoriesPaginate();
    } catch (error) {
    }
}

function onShowConfirm(id) {
    alertHelper.confirmDelete()
        .then((result) => {
            if (result.isConfirmed) {
                deleteCategory(id);
            }
        })
}

function renderSlug(event) {
    form.slug = inputHelper.renderSlug(event);
}

async function changeActive(id) {
    try {
        const response = await postCategoryApi.changeActiveCategory(id);
        getCategoriesPaginate();
    } catch (error) {
    }
}


onMounted(async () => {
    await getCategoriesPaginate();
});
</script>
