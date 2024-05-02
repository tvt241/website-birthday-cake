import apiHelper from "~/Core/helpers/apiHelper";

export default {
    getRoles: function (){
        const url = "roles";
        return apiHelper.get(url);
    },
    addRole: function(form){
        const url = "roles";
        return apiHelper.post(url, form);
    },
    updateRole: function(id, form){
        const url = `roles/${id}`;
        return apiHelper.put(url, form);
    },
    deleteRole: function(id){
        const url = `roles/${id}`;
        return apiHelper.delete(url);
    },
    getPermissionsByRole: function(id){
        const url = `roles/${id}/permissions`;
        return apiHelper.get(url);
    },
    updatePermissionsByRole: function(id, form){
        const url = `roles/${id}/permissions`;
        return apiHelper.put(url, form);
    }
}