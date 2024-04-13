<template>
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src="http://localhost:2222/public/assets/admin/img/icons/lang.png"
                alt="">
            <span class="page-header-title">
                System setup
            </span>
        </h2>
    </div>
    <div class="mb-5 mt-5">
        <ul class="nav nav-underline-active-primary border-0 mb-3">
            <li class="nav-item">
                <router-link :to="{ name: 'settings.system-setups.mail' }" class="nav-link" exact  active-class="active">
                    Mail
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.system-setups.notification' }" class="nav-link" exact  active-class="active">
                    Thông báo
                </router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'settings.system-setups.sms' }" class="nav-link" exact  active-class="active">
                    SMS
                </router-link>
            </li>
        </ul>
    </div>

    <router-view></router-view>
</template>