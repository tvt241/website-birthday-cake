<template>
    <PageHeaderTitleComponent header-title="Thiết lập trang">
    </PageHeaderTitleComponent>
    <div class="mt-5 mb-5">
        <ul class="nav nav-underline-active-primary">
            <li class="nav-item">
                <router-link :to="{ name: 'settings.page_medias.page_setups.about_us' }" class="nav-link" exact active-class="active">
                    Về chúng tôi
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.page_medias.page_setups.terms_and_condition' }" class="nav-link" exact active-class="active">
                    Điều khoản và điều kiện
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.page_medias.page_setups.privacy_policy' }" class="nav-link" exact
                    active-class="active">
                    Chính sách bảo mật
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.page_medias.page_setups.return_policy' }" class="nav-link" exact
                    active-class="active">
                    Chính sách trả hàng
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.page_medias.page_setups.refund_policy' }" class="nav-link" exact
                    active-class="active">
                    Chính sách hoàn tiền
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.page_medias.page_setups.cancellation_policy' }" class="nav-link" exact
                    active-class="active">
                    Chính sách hủy
                </router-link>
            </li>
        </ul>
    </div>
    <router-view></router-view>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";

</script>