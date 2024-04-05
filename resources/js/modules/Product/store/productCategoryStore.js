import { defineStore } from "pinia";
import { ref } from "vue";

export const useProductCategoryStore = defineStore("productCategoryStore", () => {
    const itemActives = ref([]);
    function addItemActive(id) {
        itemActives.value.push(id);
    }

    function removeItemActive(id){
        itemActives.value = itemActives.value.filter(idItem => idItem != id);
    }
    
    return { itemActives, addItemActive, removeItemActive };
});
