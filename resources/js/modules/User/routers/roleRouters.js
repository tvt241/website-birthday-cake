import RoleList from '~/User/views/Role/RoleList.vue';
import RolePermissionEdit from '~/User/views/Role/RolePermissionEdit.vue';


export default [
    {
        path: '/roles',
        children: [
            {
                path: "",
                component: RoleList,
                name: 'roles',
            },
            {
                path: ":id",
                component: RolePermissionEdit,
                name: 'roles.details',
            },
        ]
    },
];
