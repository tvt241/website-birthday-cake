import apiHelper from "~/Core/helpers/apiHelper";

export default {
    getUsersPaginate: function (paramSearch = {}){
        const url = "employees";
        return apiHelper.get(url, paramSearch);
    },
    addUser: function(form){
        const url = "employees";
        return apiHelper.postRaw(url, form);
    },
    getUser: function(id){
        const url = `employees/${id}`;
        return apiHelper.get(url);
    },
    updateUser: function(id, form){
        const url = `employees/${id}`;
        return apiHelper.putRaw(url, form);
    },
    deleteUser: function(id){
        const url = `employees/${id}`;
        return apiHelper.delete(url);
    },
    getPermissionsByUser: function(id){
        const url = `employees/${id}/permissions`;
        return apiHelper.get(url);
    },
    updatePermissionsByUser: function(id, form){
        const url = `employees/${id}/permissions`;
        return apiHelper.put(url, form);
    }
}