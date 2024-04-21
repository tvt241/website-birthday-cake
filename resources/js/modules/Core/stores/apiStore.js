import { defineStore } from "pinia";
import { ref } from "vue";
import authApi from "../apis/authApi";
import { getItem, removeItem, setItem } from "~/Core/helpers/localStorageHelper";

export const useApiStore = defineStore("apiStore", () => {
    const retry = ref(0); 
    const maxTry = ref(0); 
    
    function resetTry(){
        retry.value = 0;
    }

    function incrementTry(){
        retry.value = retry.value + 1 
    }

    function setMaxTry(count){
        maxTry.value = count;
    }

    function checkMaxTry(){
        if(maxTry.value === retry.value){
            return true;
        }
        return false;
    }

    return { resetTry, incrementTry, setMaxTry, checkMaxTry };
});


