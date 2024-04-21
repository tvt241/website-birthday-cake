import apiHelper from "~/Core/helpers/apiHelper";

export default {
    getProductsPaginate: function (paramSearch = {}){
    const url = "products";
        return apiHelper.get(url, paramSearch);
    },
    addProduct: function(form){
        const url = "products";
        return apiHelper.postRaw(url, form);
    },
    getProduct: function(id){
        const url = `products/${id}`;
        return apiHelper.get(url);
    },
    updateProduct: function(id, form){
        const url = `products/${id}`;
        return apiHelper.putRaw(url, form);
    },
    deleteProduct: function(id){
        const url = `products/${id}`;
        return apiHelper.delete(url);
    },
    changeActiveProduct: function(id){
        const url = `products/${id}/change-active`;
        return apiHelper.put(url);
    },
}