import ProductCategoryList from "../views/Category/ProductCategoryList.vue";
import ProductCreate from "../views/Product/ProductCreate.vue";
import ProductEdit from "../views/Product/ProductEdit.vue";
import ProductList from "../views/Product/ProductList.vue";


export default [
    {
        path: '/products',
        children: [
            {
                path: "",
                component: ProductList,
                name: 'products',
            },
            {
                path: "create",
                component: ProductCreate,
                name: 'products.create',
            },
            {
                path: ":id/edit",
                component: ProductEdit,
                name: 'products.edit',
            },
        ]
    },
    {
        path: "/categories",
        children: [
            {
                path: "",
                component: ProductCategoryList,
                name: "products.categories"
            }
        ]
    }
];
