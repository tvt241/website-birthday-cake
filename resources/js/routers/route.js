import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "~/User/store/authStore";
import { getItem } from "~/Core/helpers/localStorageHelper";
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

router.beforeEach(async (to, from) => {
    const store = useAuthStore();
    const token = getItem("token");
    if(!token && to.name != "auth.login"){
      return { name: "auth.login" };
    }
    if(token){
      await store.setInfo();
    }
    if(token && to.name == 'auth.login'){
      return { name: "pos" };
    }
    let currentMenu = null;
    const menus = store.getMenus();
    const path = to.path.slice(1);
    // for (const key in menus) {
    //   if (Object.hasOwnProperty.call(menus, key)) {
    //     for (let indexMdl = 0; indexMdl < menus[key].length; indexMdl++) {
    //       const mdl = menus[key][indexMdl];
    //       if(mdl.url === path){
    //         console.log(currentMenu);
    //         currentMenu = mdl;
    //         break;
    //       }
    //       if(mdl.children?.length){
    //         for (let indexSub = 0; indexSub < mdl.children.length; indexSub++) {
    //           const sub_menu = mdl.children[indexSub];
    //           if(sub_menu.url === path){
    //             console.log(currentMenu);
    //             currentMenu = sub_menu;
    //             break;
    //           }
    //         }
    //       }
    //     }
    //   }
    // }
    // if(!currentMenu){
    //   return {
    //     name: "pos"
    //   }
    // }
    // const store = useAuthStore();
    // await store.getInfo();

    // document.title = currentMenu.title;
}); 

export default router;
