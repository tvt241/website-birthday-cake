<template>
    <select class="form-control" :id="id" :required="required"></select>
</template>
  
<script setup>
import $ from 'jquery';
import select2 from 'select2';
import { ref, defineEmits, defineProps, onMounted } from "vue";

const instance = ref(null);

const emits = defineEmits(["update:modelValue"]);
const props = defineProps({
    modelValue: [String, Array],
    id: {
        type: String,
    },
    options: {
        type: Array,
        default: []
    },
    settings: {
        type: Object,
        default: {}
    }
});

onMounted(() => {
    console.log(select2);
    instance.value = $(`#${props.id}`).select2({
        data: props.options,
        ...props.settings
    });
})

// export default {
//   name: 'Select2',
//   data() {
//     return {
//       select2: null
//     };
//   },
//   emits: ['update:modelValue'],
//   props: {
//     modelValue: [String, Array], // previously was `value: String`
//     id: {
//       type: String,
//       default: ''
//     },
//     options: {
//       type: Array,
//       default: () => []
//     },
//     settings: {
//       type: Object,
//       default: () => {}
//     },
//   },
//   watch: {
//     options: {
//       handler(val) {
//         this.setOption(val);
//       },
//       deep: true
//     },
//     modelValue: {
//       handler(val) {
//         this.setValue(val);
//       },
//       deep: true
//     },
//   },
//   methods: {
//     setOption(val = []) {
//       this.select2.empty();
//       this.select2.select2({
//         placeholder: this.placeholder,
//         ...this.settings,
//         data: val
//       });
//       this.setValue(this.modelValue);
//     },
//     setValue(val) {
//       if (val instanceof Array) {
//         this.select2.val([...val]);
//       } else {
//         this.select2.val([val]);
//       }
//       this.select2.trigger('change');
//     }
//   },
//   mounted() {
//     this.select2 = $(this.$el)
//       .find('select')
//       .select2({
//         placeholder: this.placeholder,
//         ...this.settings,
//         data: this.options
//       })
//       .on('select2:select select2:unselect', ev => {
//         this.$emit('update:modelValue', this.select2.val());
//         this.$emit('select', ev['params']['data']);
//       });
//     this.setValue(this.modelValue);
//   },
//   beforeUnmount() {
//     this.select2.select2('destroy');
//   }
// };
</script>
  