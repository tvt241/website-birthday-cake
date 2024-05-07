<template>
    <img :src="barcodeImage" :alt="props.value">
    <p class="barcode-value">{{ props.value }}</p>
</template>

<script setup>
import JsBarcode from 'jsbarcode';
import { defineProps, defineEmits, onMounted, ref } from 'vue';

const emits = defineEmits(["onPrint"]);

const props = defineProps({
    value: {
        type: String,
    },
    format: {
        type: String,
        default: "CODE128"
    },
    styles: {
        type: Object,
        default: {}
    }
});

const barcodeImage = ref(null);

function generateBarcode() {
    JsBarcode("#barcode", props.value, {
        format: props.format,
        displayValue: false,
        width: 1,
        height: 40,
        fontSize: 10
    });
    barcodeImage.value = document.getElementById("barcode").src;
}

onMounted(() => {
    generateBarcode()
})
</script>

<style>
    .barcode-value{
        font-size: 12px;
    }
</style>