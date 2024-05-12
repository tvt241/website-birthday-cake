<template>
    <aside class="left-sidebar sidebar-light" id="left-sidebar">
        <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
                <router-link :to="{ name: 'pos' }">
                    <img style="width: 110px;" :src="settings.logo" :alt="settings.name" />
                    <!-- <span class="brand-name">{{ settings.name }}</span> -->
                </router-link>
            </div>
            <!-- begin sidebar scrollbar -->
            <Simplebar class="sidebar-left" style="height: 100%;">
                <ul class="nav sidebar-inner" id="sidebar-menu">
                    <template v-for="(mdl, key) in menus">
                        <li v-if="key" class="section-title">{{ key }}</li>
                        <template v-for="menu in mdl">
                            <li v-if="menu.is_sub === '1'" class="has-sub">
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse-custom"
                                    :data-target="'#' + menu.name">
                                    <i :class="menu.icon"></i>
                                    <span class="nav-text">{{ menu.label }}</span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="collapse-custom" style="display: none;" :id="menu.name"
                                    data-parent="#sidebar-menu">
                                    <template v-for="sub_menu in menu.children">
                                        <li>
                                            <router-link class="sidenav-item-link" active-class="active"
                                                :to="{ name: sub_menu.name }">
                                                <span class="nav-text">{{ sub_menu.label }}</span>
                                            </router-link>
                                        </li>
                                    </template>
                                </ul>
                            </li>
                            <li v-else-if="menu.children?.length" v-for="sub_menu in menu.children">
                                <router-link :to="{ name: sub_menu.name }"
                                    active-class="active" class="sidenav-item-link">
                                    <i :class="sub_menu.icon"></i>
                                    <span class="nav-text">{{ sub_menu.label }}</span>
                                </router-link>
                            </li>
                            <li v-else>
                                <router-link :to="{ name: menu.name }"
                                    active-class="active" class="sidenav-item-link">
                                    <i :class="menu.icon"></i>
                                    <span class="nav-text">{{ menu.label }}</span>
                                </router-link>
                            </li>
                        </template>
                    </template>
                </ul>
            </Simplebar>
        </div>
    </aside>
</template>

<script setup>
import Simplebar from 'simplebar-vue';
import 'simplebar-vue/dist/simplebar.min.css';

import { ref } from 'vue';
import { useAuthStore } from '~/User/store/authStore';
import { useSettingStore } from '~/Setting/store/settingStore';

const store = useAuthStore();
const settingStore = useSettingStore();

const settings = settingStore.getSettings();

const menus = ref(store.getMenus());

function checkLabelChildren(data){
    if(!data){
        return false;
    }
    const menuInvaLid = data.filter((sub_menu) => {
        return sub_menu.label
    });
    if(!menuInvaLid.length){
        return false;
    }
    return true;
}
</script>

<style>

</style>