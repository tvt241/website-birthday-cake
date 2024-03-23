import Login from "../views/Auth/Login.vue";
import Register from "../views/Auth/Register.vue";
import ForgotPassword from "../views/Auth/ForgotPassword/ForgotPassword.vue";
import ForgotPasswordVerify from "../views/Auth/ForgotPassword/ForgotPasswordVerify.vue";
import ForgotPasswordResetPassword from "../views/Auth/ForgotPassword/ForgotPasswordResetPassword.vue";

export default [
    {
        path: '/login',
        component: Login,
        name: 'auth.login',
    },
    {
        path: '/register',
        component: Register,
        name: 'auth.register',
    },
    {
        path: '/forgot-password',
        name: 'auth.forgot-password',
        children: [
            {
                path: "/",
                component: ForgotPassword,
                name: '',
            },
            {
                path: "/verify",
                component: ForgotPasswordVerify,
                name: 'verify',
            },
            {
                path: "/reset-password",
                component: ForgotPasswordResetPassword,
                name: 'reset-password',
            }
        ]
    },
];
