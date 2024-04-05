<template>
   <template v-for="category in categories" :key="category.id">
      <tr :class="{ 'd-none': category.depth !== 0 }"
         :data-id="category.id" :data-parent-id="category.category_id">
         <td>
            <span v-html="renderDepth(category.depth)"></span>
            <i v-if="category.children.length" class="mdi mdi-chevron-right"
               @click="$emit('handleToggleChild', $event, category.id)"></i>
         </td>
         <td>
            <div class="media align-items-center gap-3">
               <div class="avatar">
                  <img :src="category.image ?? IMG_DEFAULT" class="rounded img-fit">
               </div>
               <div class="media-body">
                  <a class="text-dark">
                     {{ category.name }}
                  </a>
               </div>
            </div>
         </td>
         <td>
            <a class="text-dark">
               {{ category.slug }}
            </a>
         </td>
         <td>
            <label class="switcher">
               <input type="checkbox" @click="$emit('changeActive', category.id)" class="switcher_input" checked>
               <span class="switcher_control"></span>
            </label>
         </td>
         <td>
            <div class="d-flex justify-content-start align-items-center gap-2">
               <button class="btn btn-sm btn-outline-info square-btn" type="button" data-target="#modal-category"
                  data-toggle="modal" @click="$emit('showEdit', category.id)">
                  <i class="mdi mdi-pencil"></i>
               </button>
               <button class="btn btn-sm btn-outline-danger square-btn" @click="$emit('showConfirm', category.id)">
                  <i class="mdi mdi-trash-can"></i>
               </button>
            </div>
         </td>
      </tr>
      <ProductCategoryChildComponent v-if="category.children.length" 
         :categories="category.children" 
         @show-confirm="(id) => $emit('showConfirm', id)"
         @show-edit="(id) => $emit('showEdit', id)"
         @handle-toggle-child="(event, id) => $emit('handleToggleChild', event, id)"
      />
   </template>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';
import { IMG_DEFAULT } from "~/Core/helpers/imageHelper";
const props = defineProps(["categories"]);

const emits = defineEmits(["showConfirm", "showEdit", "handleToggleChild"]);

function renderDepth(depth) {
   let html = "";
   for (let i = 0; i < depth; i++) {
      html += '<i class="mdi mdi-minus"></i>'
   }
   return html;
}

</script>

<style scoped>
td {
   vertical-align: middle;
}
</style>