<template>
    <div class="form-field pb-4 pr-4">
        <label>{{ label }}</label>
        <input
            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
        <div v-if="error" class="text-red-700 text-sm">{{ error[0] }}</div>
    </div>
</template>

<script>
import {defineComponent} from 'vue'

export default defineComponent({
    props: ['modelValue', 'label', 'error'],

    emits: ['update:modelValue'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    },
    mounted() {
        console.log("this.modelValue",this.modelValue)
    }
})
</script>
