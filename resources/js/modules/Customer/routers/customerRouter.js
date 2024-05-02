import CustomerCreate from "../views/Customer/CustomerCreate.vue";
import CustomerDetails from "../views/Customer/CustomerDetails.vue";
import CustomerEdit from "../views/Customer/CustomerEdit.vue";
import CustomerList from "../views/Customer/CustomerList.vue";


export default [
    {
        path: '/customers',
        children: [
            {
                path: "",
                component: CustomerList,
                name: 'customers',
            },
            {
                path: "create",
                component: CustomerCreate,
                name: 'customers.create',
            },
            {
                path: ":id",
                component: CustomerDetails,
                name: 'customers.details',
            },
            {
                path: ":id/edit",
                component: CustomerEdit,
                name: 'customers.edit',
            },
        ],
    },
];
