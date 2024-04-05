<template>
    <ckeditor :editor="editor" v-model="content" :config="editorConfig">
    </ckeditor>
</template>

<script setup>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { defineModel } from "vue";

const editor = ClassicEditor;
const content = defineModel("content");
const editorConfig = {
    toolbar: [
        'undo',
        'redo',
        '|',
        'heading',
        '|',
        'bold',
        'italic',
        '|',
        'link',
        'uploadImage',
        'CKFinder',
        'insertTable',
        'blockQuote',
        'mediaEmbed',
        'numberedList',
        'bulletedList',
        'outdent',
        'indent'
    ],
}
</script>

<style>
.ck-editor__editable {
    min-height: 115px !important;
}
</style>