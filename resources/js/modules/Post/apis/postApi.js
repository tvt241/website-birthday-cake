import apiHelper from "~/Core/helpers/apiHelper";

export default {
    getPostsPaginate: function (paramSearch = {}){
    const url = "posts";
        return apiHelper.get(url, paramSearch);
    },
    addPost: function(form){
        const url = "posts";
        return apiHelper.postRaw(url, form);
    },
    getPost: function(id){
        const url = `posts/${id}`;
        return apiHelper.get(url);
    },
    updatePost: function(id, form){
        const url = `posts/${id}`;
        return apiHelper.putRaw(url, form);
    },
    deletePost: function(id){
        const url = `posts/${id}`;
        return apiHelper.delete(url);
    },
    changeActivePost: function(id){
        const url = `posts/${id}`;
        return apiHelper.put(url);
    },
}