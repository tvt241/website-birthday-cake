import apiHelper from "~/Core/helpers/apiHelper";

export default {
    getCategoriesPaginate: function (paramSearch = {}){
    const url = "posts/categories";
        return apiHelper.get(url, paramSearch);
    },
    getCategories: function(){
        const url = `posts/categories/get-all`;
        return apiHelper.get(url);
    },
    addCategory: function(form){
        const url = "posts/categories";
        return apiHelper.post(url, form);
    },
    getCategory: function(id){
        const url = `posts/categories/${id}`;
        return apiHelper.get(url);
    },
    updateCategory: function(id, form){
        const url = `posts/categories/${id}`;
        return apiHelper.put(url, form);
    },
    deleteCategory: function(id){
        const url = `posts/categories/${id}`;
        return apiHelper.delete(url);
    },
    changeActiveCategory: function(id){
        const url = `posts/categories/${id}`;
        return apiHelper.put(url);
    },
    

}