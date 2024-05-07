import apiHelper from "~/Core/helpers/apiHelper";

export default {
    getCustomersPaginate: function (paramSearch = {}){
    const url = "customers";
        return apiHelper.get(url, paramSearch);
    },
    addCustomer: function(form){
        const url = "customers";
        return apiHelper.postRaw(url, form);
    },
    getCustomer: function(id){
        const url = `customers/${id}`;
        return apiHelper.get(url);
    },
    updateCustomer: function(id, form){
        const url = `customers/${id}`;
        return apiHelper.putRaw(url, form);
    },
    deleteCustomer: function(id){
        const url = `customers/${id}`;
        return apiHelper.delete(url);
    },
    changeActiveCustomer: function(id, is_active){
        const form = {
            is_active
        }
        const url = `customers/${id}/change-active`;
        return apiHelper.put(url, form);
    },
}