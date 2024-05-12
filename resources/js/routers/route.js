import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "~/User/store/authStore";
import { useGlobalStore } from "~/Core/stores/globalStore";
import i18n from "~/Core/i18n";
import dashboardRouter from "~/Core/routes/dashboardRouter";
import orderRouter from "~/Order/router";
import productRoutes from "~/Product/routers/productRoutes";
import postRoutes from "~/Post/router";
import bannerRouter from "~/Banner/router";
import couponRouter from "~/Coupon/router";
import notificationRouter from "~/Notification/router";
import customerRouter from "~/Customer/router";
import userRouter from "~/User/router";
import settingRoutes from "~/Setting/routers/settingRoutes";

const routes = [].concat(
    dashboardRouter,
    orderRouter,
    productRoutes,
    postRoutes,
    bannerRouter,
    couponRouter,
    notificationRouter,
    customerRouter,
    userRouter,
    settingRoutes,
);

const { t } = i18n.global;

const router = createRouter({
    history: createWebHistory("/admin"),
    routes,
});

router.beforeEach((to, from) => {
    const authStore = useAuthStore();
    const globalStore = useGlobalStore();
    globalStore.setStatus(200);

    if(to.name != "auth.login" && !authStore.isLogin){
      globalStore.setPreRoute(to.fullPath);
      return { name: "auth.login" };
    }

    if(authStore.isLogin && to.name == 'auth.login'){
      return { name: "pos" };
    }
    if(to.name != "NotFound"){
      let currentMenu = null;
      const roles = authStore.getRoles();
      for (let index = 0; index < roles.length; index++) {
        if(roles[index].name === to.name){
          currentMenu = roles[index];
          break;
        }
      }
      if(!currentMenu){
        if(from.name === "auth.login"){
          globalStore.setPreRoute("/pos");
        }
        else{
          globalStore.setPreRoute(from.fullPath);
        }
        globalStore.setStatus(403);
      }
      else{
        document.title = currentMenu.title;
      }
    }
    else{
      if(from.name){
        globalStore.setPreRoute(from.fullPath);
      }
      else{
        globalStore.setPreRoute("/pos");
      }
      globalStore.setStatus(404);
    }

}); 

export default router;
