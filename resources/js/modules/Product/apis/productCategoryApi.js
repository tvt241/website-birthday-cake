import apiHelper from "~/Core/helpers/apiHelper";

export default {
    getCategoriesPaginate: function (paramSearch = {}){
    const url = "categories";
        return apiHelper.get(url, paramSearch);
    },
    getCategories: function(){
        const url = `categories/get-all`;
        return apiHelper.get(url);
    },
    addCategory: function(form){
        const url = "categories";
        return apiHelper.postRaw(url, form);
    },
    getCategory: function(id){
        const url = `categories/${id}`;
        return apiHelper.get(url);
    },
    updateCategory: function(id, form){
        const url = `categories/${id}`;
        return apiHelper.putRaw(url, form);
    },
    deleteCategory: function(id){
        const url = `categories/${id}`;
        return apiHelper.delete(url);
    },
    changeActiveCategory: function(id){
        const url = `categories/${id}/change-active`;
        return apiHelper.put(url);
    },
}