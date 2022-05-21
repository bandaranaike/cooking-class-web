<template>
    <div id="app">
        <div class="home-gallery-container">
            <grid-images :cells="5" :items='images'></grid-images>
        </div>
    </div>
</template>

<script setup>
import GridImages from '@chinhpd/vue3-grid-images';
// stylesheet
import '@morioh/v-lightbox/dist/lightbox.css';

const images = ["/images/sliders/sl-1.jpg", "/images/sliders/sl-2.jpg", "/images/sliders/sl-1.jpg"];

console.log(GridImages)

defineProps({
    items: {
        type: Array,
        default: () => {
            return []
        }
    },
    css: {
        type: String,
        default: () => 'h-250 h-md-400 h-lg-600'
    },
    cells: {
        type: Number,
        default: () => 5
    }
})

</script>
<style>

.home-gallery-container {
    width: 800px;
    height: 600px;
    margin: 50px auto;
}
</style>
