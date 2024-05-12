import NotFound from "../errors/NotFound.vue";
import Dashboard from "../views/Dashboard.vue";

export default [
    {
        path: '/',
        redirect: {
            name: "pos"
        }
    },
    {
        path: '/dashboard',
        component: Dashboard,
        name: 'dashboard',
    },

    { 
        path: '/:pathMatch(.*)*', 
        component: NotFound,
        name: 'NotFound', 
    },
   
];
