import NotificationList from "../views/Notification/NotificationList.vue";

export default [
    {
        path: '/notifications',
        children: [
            {
                path: "",
                component: NotificationList,
                name: 'notifications',
            },
        ],
    },
];
