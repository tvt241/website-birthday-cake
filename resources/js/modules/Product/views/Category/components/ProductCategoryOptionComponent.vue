<template>
   <template v-if="categories.length" v-for="category in categories" :key="category.id">
      <option :value="category.id" v-html="renderDepth(category.depth, category.name)"></option>
      <ProductCategoryOptionComponent v-if="category.children.length" :categories="category.children" />
   </template>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps(["categories"]);

function renderDepth(depth, name) {
   let html = "";
   for (let i = 0; i < depth; i++) {
      html += '-'
   }
   html += name;
   return html;
}
</script>