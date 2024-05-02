import OrderCreate from "../views/Order/OrderCreate.vue";
import OrderDetails from "../views/Order/OrderDetails.vue";
import OrderEdit from "../views/Order/OrderEdit.vue";
import OrderList from "../views/Order/OrderList.vue";
import PaymentDetails from "../views/Payment/PaymentDetails.vue";
import PaymentList from "../views/Payment/PaymentList.vue";


export default [
    {
        path: '/orders',
        children: [
            {
                path: "",
                component: OrderList,
                name: 'orders',
            },
            {
                path: "create",
                component: OrderCreate,
                name: 'orders.create',
            },
            {
                path: ":id",
                component: OrderDetails,
                name: 'orders.details',
            },
            {
                path: ":id/edit",
                component: OrderEdit,
                name: 'orders.edit',
            },
        ],
    },
    {
        path: '/payments',
        children: [
            {
                path: "",
                component: PaymentList,
                name: 'payment',
            },
            {
                path: ":id",
                component: PaymentDetails,
                name: 'payment.details',
            }
        ]
    }
];
