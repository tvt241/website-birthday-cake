import apiHelper from "~/Core/helpers/apiHelper";

export default {
    getOrdersPaginate: function (paramSearch = {}){
    const url = "orders";
        return apiHelper.get(url, paramSearch);
    },
    addOrder: function(form){
        const url = "orders";
        return apiHelper.postRaw(url, form);
    },
    getOrder: function(id){
        const url = `orders/${id}`;
        return apiHelper.get(url);
    },
    updateOrder: function(id, form){
        const url = `orders/${id}`;
        return apiHelper.putRaw(url, form);
    },
    deleteOrder: function(id){
        const url = `orders/${id}`;
        return apiHelper.delete(url);
    },
    // changeActiveOrder: function(id){
    //     const url = `orders/${id}`;
    //     return apiHelper.put(url);
    // },
}