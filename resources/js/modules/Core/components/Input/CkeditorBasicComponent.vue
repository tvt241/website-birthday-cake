<template>
    <ckeditor :editor="editor" v-model="content">
    </ckeditor>
</template>

<script setup>
import ClassicEditor from '~/Core/customs/ckeditorBasic';
import { defineModel } from "vue";

const editor = ClassicEditor;
const content = defineModel("content");

</script>

<style>
.ck-editor__editable {
    min-height: 115px !important;
}
</style>