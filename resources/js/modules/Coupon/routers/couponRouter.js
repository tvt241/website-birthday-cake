import CouponCreate from "../views/Coupon/CouponCreate.vue";
import CouponDetails from "../views/Coupon/CouponDetails.vue";
import CouponEdit from "../views/Coupon/CouponEdit.vue";
import CouponList from "../views/Coupon/CouponList.vue";

export default [
    {
        path: '/coupons',
        children: [
            {
                path: "",
                component: CouponList,
                name: 'coupons',
            },
            {
                path: "create",
                component: CouponCreate,
                name: 'coupons.create',
            },
            {
                path: ":id",
                component: CouponDetails,
                name: 'coupons.details',
            },
            {
                path: ":id/edit",
                component: CouponEdit,
                name: 'coupons.edit',
            },
        ],
    },
];
