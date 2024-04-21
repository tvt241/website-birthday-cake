import Dashboard from "../views/Dashboard.vue";

export default [
    {
        path: '/dashboard',
        component: Dashboard,
        name: 'dashboard',
    },
    {
        path: '/',
        redirect: {
            name: "dashboard"
        }
    },
];
