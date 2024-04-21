import UserCreate from "../views/User/UserCreate.vue";
import UserDetails from "../views/User/UserDetails.vue";
import UserEdit from "../views/User/UserEdit.vue";
import UserList from "../views/User/UserList.vue";


export default [
    {
        path: '/employees',
        children: [
            {
                path: "",
                component: UserList,
                name: 'employees',
            },
            {
                path: "create",
                component: UserCreate,
                name: 'employees.create',
            },
            {
                path: ":id",
                component: UserDetails,
                name: 'employees.details',
            },
            {
                path: ":id/edit",
                component: UserEdit,
                name: 'employees.edit',
            },
        ]
    },
];
