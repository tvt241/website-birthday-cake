import apiHelper from "~/Core/helpers/apiHelper";

export default {
    getBannersPaginate: function (paramSearch = {}){
    const url = "banners";
        return apiHelper.get(url, paramSearch);
    },
    addBanner: function(form){
        const url = "banners";
        return apiHelper.postRaw(url, form);
    },
    getBanner: function(id){
        const url = `banners/${id}`;
        return apiHelper.get(url);
    },
    updateBanner: function(id, form){
        const url = `banners/${id}`;
        return apiHelper.putRaw(url, form);
    },
    deleteBanner: function(id){
        const url = `banners/${id}`;
        return apiHelper.delete(url);
    },
    getOrder: function(){
        const url = `banners/order`;
        return apiHelper.get(url);
    },
    changeActiveBanner: function(id){
        const url = `banners/${id}`;
        return apiHelper.put(url);
    },
}