<template>
    <aside class="left-sidebar sidebar-light" id="left-sidebar">
        <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
                <a href="/index.html">
                    <img src="images/logo.png" alt="Mono" />
                    <span class="brand-name">MONO</span>
                </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-left" data-simplebar style="height: 100%">
                <!-- sidebar menu -->
                <ul class="nav sidebar-inner" id="sidebar-menu">
                    <template v-for="mdl in modules">
                        <li class="section-title">{{ mdl.name }}</li>
                        <template v-for="menu in mdl.menu">
                            <template v-if="!menu.sub">
                                <li>
                                    <router-link :to="'/' + arrayToStringWithSeparator('/', mdl.path, menu.path)" class="sidenav-item-link">
                                        <i class="mdi mdi-wechat"></i>
                                        <span class="nav-text">{{ menu.name }}</span>
                                    </router-link>
                                </li>
                            </template>
                            <template v-else>
                                <li class="has-sub">
                                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                        :data-target="'#' + arrayToStringWithSeparator('-', mdl.path, menu.path)">
                                        <i class="mdi mdi-email"></i>
                                        <span class="nav-text">{{ menu.name }}</span>
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="collapse" :id="arrayToStringWithSeparator('-', mdl.path, menu.path)" data-parent="#sidebar-menu">
                                        <li v-for="sub_menu in menu.sub">
                                                <router-link class="sidenav-item-link"
                                                    :to="'/' + arrayToStringWithSeparator('/', mdl.path, menu.path, sub_menu.path)">
                                                    <span class="nav-text">{{ sub_menu.name }}</span>
                                                </router-link>
                                        </li>
                                    </ul>
                                </li>
                            </template>
                        </template>
                    </template>
                </ul>
            </div>
            <!-- <div class="sidebar-footer">
                <div class="sidebar-footer-content">
                    <ul class="d-flex">
                        <li>
                            <a href="user-account-settings.html" data-toggle="tooltip" title="Profile settings"><i
                                    class="mdi mdi-settings"></i></a>
                        </li>
                        <li>
                            <a href="#" data-toggle="tooltip" title="No chat messages"><i
                                    class="mdi mdi-chat-processing"></i></a>
                        </li>
                    </ul>
                </div>
            </div> -->
        </div>
    </aside>
</template>

<script setup>
import { ref } from 'vue';
// import ButtonShowNav from "../components/Button/ButtonShowNav.vue";
// import { useNavStore } from '../stores/navbarStore';

// const navStore = useNavStore();

const modules = [
    {
        name: "Product",
        path: "products",
        menu: [
            {
                name: "Product",
                path: "",
                sub: [
                    {
                        name: "Product List",
                        path: ""
                    },
                    {
                        name: "Product Add",
                        path: "create"
                    }
                ]
            },
            {
                name: "Category",
                path: "categories"
            }
        ]
    },
    {
        name: "Setting",
        path: "settings",
        menu: [
            {
                name: "Business Setup",
                path: "business-setups",
            },
            {
                name: "Page & Media",
                path: "page-medias",
                sub: [
                    {
                        name: "Page Setup",
                        path: "page-setups"
                    },
                    {
                        name: "Social Media",
                        path: "social-medias"
                    }
                ]
            },
            {
                name: "Template setup",
                path: "system-setups",
            },
            {
                name: "System setup",
                path: "system-setups",
            },
        ]
    }
];

// function toggleSubMenu(event) {
//     const classList = event.target.parentElement.parentElement.classList;
//     const isActive = classList.contains("show");
//     const listMenu = document.querySelectorAll(".navbar-vertical-aside-has-menu");
//     listMenu.forEach((menu) => {
//         menu.classList.remove("show");
//     });
//     if(!isActive){
//         event.target.parentElement.parentElement.classList.add("show");
//     }
// }

// function searchMenu(event) {
//     const rows = document.querySelectorAll(".navbar-vertical-content .navbar-nav>li");
//     const value = event.target.value.trim().toLowerCase();
//     rows.forEach((item) => {
//         if(item.textContent.toLowerCase().indexOf(value) < 0){
//             item.style.display = "none";
//             return;
//         }
//         item.style.display = "block";
//     });
// }
const arrayToStringWithSeparator= (separator,...args) => args.filter((value) => value).join(separator);
</script>