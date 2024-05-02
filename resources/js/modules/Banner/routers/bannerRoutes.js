import BannerCreate from "../views/Banner/BannerCreate.vue";
import BannerEdit from "../views/Banner/BannerEdit.vue";
import BannerList from "../views/Banner/BannerList.vue";


export default [
    {
        path: '/banners',
        children: [
            {
                path: "",
                component: BannerList,
                name: 'banners',
            },
            {
                path: "create",
                component: BannerCreate,
                name: 'banners.create',
            },
            {
                path: ":id/edit",
                component: BannerEdit,
                name: 'banners.edit',
            },
        ]
    }
];
