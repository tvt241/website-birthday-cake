<template>
    <PageHeaderTitleComponent header-title="Thiết lập hệ thống">
    </PageHeaderTitleComponent>
    <div class="mb-5 mt-5">
        <ul class="nav nav-underline-active-primary border-0 mb-3">
            <li class="nav-item">
                <router-link :to="{ name: 'settings.system_setups.mail' }" class="nav-link" exact  active-class="active">
                    Mail
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.system_setups.notification' }" class="nav-link" exact  active-class="active">
                    Thông báo
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.system_setups.sms' }" class="nav-link" exact  active-class="active">
                    SMS
                </router-link>
            </li>
        </ul>
    </div>

    <router-view></router-view>
</template>

<script setup>
import PageHeaderTitleComponent from "~/Core/components/PageHeaderTitleComponent.vue";

</script>