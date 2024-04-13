import PostCategoryList from "../views/Category/PostCategoryList.vue";
import PostCreate from "../views/Post/PostCreate.vue";
import PostEdit from "../views/Post/PostEdit.vue";
import PostList from "../views/Post/PostList.vue";


export default [
    {
        path: '/posts',
        children: [
            {
                path: "",
                component: PostList,
                name: 'posts',
            },
            {
                path: "create",
                component: PostCreate,
                name: 'posts.create',
            },
            {
                path: "categories",
                component: PostCategoryList,
                name: "posts.categories"
            },
            {
                path: ":id/edit",
                component: PostEdit,
                name: 'posts.edit',
            },
        ]
    }
];
