import { createRouter, createWebHistory } from "vue-router";
// import authRoutes from "~/User/routers/authRoutes";
// import roleRouters from "~/User/routers/roleRouters";
import productRoutes from "~/Product/routers/productRoutes";
import settingRoutes from "~/Setting/routers/settingRoutes";
import i18n from "~/Core/i18n";
import { useAuthStore } from "~/User/store/authStore";
import { getItem } from "~/Core/helpers/localStorageHelper";
import dashboardRouter from "~/Core/routes/dashboardRouter";
import orderRouter from "~/Order/router";
import userRouter from "~/User/router";
import couponRouter from "~/Coupon/router";
import notificationRouter from "~/Notification/router";
import customerRouter from "~/Customer/router";
import postRoutes from "~/Post/router";

const routes = [].concat(
    dashboardRouter,
    userRouter,
    couponRouter,
    notificationRouter,
    customerRouter,
    orderRouter,
    productRoutes,
    postRoutes,
    settingRoutes,
);

const { t } = i18n.global;

const router = createRouter({
    history: createWebHistory("/admin"),
    routes,
});

router.beforeEach(async (to, from) => {
    const store = useAuthStore();
    const token = getItem("token");
    if(token){
      await store.getInfo();
    }
    if(token && to.name == 'auth.login'){
      return {
        name: "dashboard"
      }
    }
    if(!token && to.name != "auth.login"){
      return {
        name: "auth.login"
      }
    }
    // const store = useAuthStore();
    // await store.getInfo();

    // document.title = "Shop" + (to.meta.title ? " | " + t(to.meta.title) : "");
}); 

export default router;
