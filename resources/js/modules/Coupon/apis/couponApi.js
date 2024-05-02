import apiHelper from "~/Core/helpers/apiHelper";

export default {
    getCouponsPaginate: function (paramSearch = {}){
    const url = "coupons";
        return apiHelper.get(url, paramSearch);
    },
    addCoupon: function(form){
        const url = "coupons";
        return apiHelper.postRaw(url, form);
    },
    getCoupon: function(id){
        const url = `coupons/${id}`;
        return apiHelper.get(url);
    },
    updateCoupon: function(id, form){
        const url = `coupons/${id}`;
        return apiHelper.putRaw(url, form);
    },
    deleteCoupon: function(id){
        const url = `coupons/${id}`;
        return apiHelper.delete(url);
    },
    // changeActiveOrder: function(id){
    //     const url = `orders/${id}`;
    //     return apiHelper.put(url);
    // },
}