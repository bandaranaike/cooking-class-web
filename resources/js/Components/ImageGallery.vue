<template>
    <div id="app">
        <div class="home-gallery-container">
            <grid-images :cells="cells" :items='items' :class="css"></grid-images>
        </div>
    </div>
</template>

<script setup>
import GridImages from '@chinhpd/vue3-grid-images';

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
img {
    display: unset !important;
}

.home-gallery-container {
    width: 800px;
    height: 600px;
    margin: 30px auto 50px;
    max-width: 100%;
    max-height: 50vh;
}
</style>
