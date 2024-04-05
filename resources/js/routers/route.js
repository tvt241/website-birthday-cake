import { createRouter, createWebHistory } from "vue-router";
import authRoutes from "~/User/routers/authRoutes";
import productRoutes from "~/Product/routers/productRoutes";
import settingRoutes from "~/Setting/routers/settingRoutes";
import i18n from "~/Core/i18n";

const routes = [].concat(
    authRoutes, 
    productRoutes, 
    settingRoutes
);

const { t } = i18n.global;

const router = createRouter({
    history: createWebHistory("/admin"),
    routes,
});

router.beforeEach((to, from) => {
    document.title = "Shop" + (to.meta.title ? " | " + t(to.meta.title) : "");

    // if (to.meta.requiresAuth && !auth.isLoggedIn()) {
    //   return {
    //     path: '/login',
    //     query: { redirect: to.fullPath },
    //   }
    // }
});

export default router;
