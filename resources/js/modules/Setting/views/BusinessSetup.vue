<template>
    <PageHeaderTitleComponent header-title="Thiết lập chung">
    </PageHeaderTitleComponent>
    
    <div class="mt-5 mb-5">
        <ul class="nav nav-underline-active-primary">
            <li class="nav-item">
                <router-link :to="{ name: 'settings.business_setup.page_setup' }" class="nav-link" exact active-class="active">
                    Thiết lập
                </router-link>
            </li>
            <!-- <li class="nav-item">
                <router-link :to="{ name: 'settings.business_setup.branch_setup' }" class="nav-link" exact active-class="active">
                    Chi nhánh
                </router-link>
            </li> -->
            <li class="nav-item">
                <router-link :to="{ name: 'settings.business_setup.notification_setup' }" class="nav-link" exact active-class="active">
                    Thông báo
                </router-link>
            </li>
        </ul>
    </div>
    <router-view></router-view>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";

</script>