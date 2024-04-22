import POS from "../views/POS/POS.vue";


export default [
    {
        path: '/pos',
        children: [
            {
                path: "",
                component: POS,
                name: 'pos',
            },
            
        ],
    },
];
