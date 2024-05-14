import apiHelper from "~/Core/helpers/apiHelper";

export default {
    getOrdersPaginate: function (paramSearch = {}){
    const url = "orders";
        return apiHelper.get(url, paramSearch);
    },
    addOrder: function(form){
        const url = "orders";
        return apiHelper.post(url, form);
    },
    getOrder: function(id){
        const url = `orders/${id}`;
        return apiHelper.get(url);
    },
    updateOrder: function(id, form){
        const url = `orders/${id}`;
        return apiHelper.putRaw(url, form);
    },
    changeStatusOrder: function(id, form){
        const url = `orders/${id}/update-status`;
        return apiHelper.put(url, form);
    },
    changeStatesOrder: function(id, form){
        const url = `orders/${id}/update-states`;
        return apiHelper.put(url, form);
    },
    deleteOrder: function(id){
        const url = `orders/${id}`;
        return apiHelper.delete(url);
    },
    getKeyOrder: function(param){
        const url = `orders/keys`;
        return apiHelper.get(url, param);
    },
}