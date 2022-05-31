<template>
    <app-layout title="Gallery">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12">
            <template v-for="gallery in galleries">
                <h3 class="text-center">{{ gallery.title }}</h3>
                <image-gallery :items="gallery.images.map(image=>('/storage/'+ image.image))"></image-gallery>
            </template>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ImageGallery from "@/Components/ImageGallery";

export default {
    name: "GalleryIndex",
    components: {ImageGallery, AppLayout},
    props: {
        galleries: Array
    }
}
</script>
