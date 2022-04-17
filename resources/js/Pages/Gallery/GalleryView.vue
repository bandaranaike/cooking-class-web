<template>
    <app-layout :title="gallery.title">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ gallery.title }}
            </h2>
        </template>

        <vue-picture-swipe :items="gallery.images"></vue-picture-swipe>

        <!--        <div class="grid grid-cols-1 md:grid-cols-3">-->

        <!--            <div class="gallery-item" v-for="image in  gallery.images">-->
        <!--                Image {{ image }}-->
        <!--                <img :src="`/storage/${image.image}`" :alt="image.title" @click="showGalleryPopup(image)">-->
        <!--            </div>-->
        <!--        </div>-->

        <!--        <x-jet-dialog-modal :show="true">-->
        <!--            <slot name="title">DDDD</slot>-->
        <!--            <x-slot name="content">DDDD</x-slot>-->
        <!--            <div class="grid grid-cols-1">-->
        <!--                currentPopupImage 1 {{ currentPopupImage }}-->
        <!--                <img :src="`/storage/${currentPopupImage.image}`" :alt="currentPopupImage.title">-->
        <!--            </div>-->
        <!--            <div class="grid xs:grid-cols-4 sm:grid-cols-6 md:grid-cols-8">-->
        <!--                <div class="gallery-thumb" v-for="image in gallery.images">-->
        <!--                    <img :src="`/storage/${image.image}`" :alt="image.title" @click="showGalleryPopup(image)">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </x-jet-dialog-modal>-->

        <!--        <modal :show="true">-->
        <!--            <div class="grid grid-cols-1">-->
        <!--                currentPopupImage 2 {{ currentPopupImage }}-->
        <!--                <img :src="`/storage/${currentPopupImage.image}`" :alt="currentPopupImage.title">-->
        <!--            </div>-->
        <!--            <div class="grid xs:grid-cols-4 sm:grid-cols-6 md:grid-cols-8">-->
        <!--                <div class="gallery-thumb" v-for="image in gallery.images">-->

        <!--                    <img :src="`/storage/${image.image}`" :alt="image.title" @click="showGalleryPopup(image)">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </modal>-->
    </app-layout>
</template>

<script>
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";
import {defineComponent} from "vue";
import {Head, Link} from "@inertiajs/inertia-vue3";
import Modal from "@/Jetstream/Modal";
import XJetDialogModal from "@/Jetstream/DialogModal";
import VuePictureSwipe from '@itadori/vue-picture-swipe-control';

export default defineComponent({
    props: {
        gallery: {images: []}
    },
    name: "GalleryView",
    components: {
        XJetDialogModal,
        Modal,
        AppLayout,
        VuePictureSwipe
    },
    data() {
        return {
            currentPopupImage: {},
            isGalleryPopupShow: false,
            gallery_1: [
                {
                    id: 1,
                    src: '/storage/gallery/S868vysoFi0ZRp5azVFv37VwjCf3wtJnpZU0qiyF.jpg',
                    thumbnail: '/storage/gallery/S868vysoFi0ZRp5azVFv37VwjCf3wtJnpZU0qiyF.jpg',
                    description: 'Star Night Sky Ravine by Mark Basarab, from Unsplash.',
                    alt: 'Blue starry night photo.',
                    thumbnailWidth: '220px',
                    h:500,
                },
                {
                    id: 2,
                    src: '/storage/gallery/0FUwDEdw3lSpEcT1cgzhyeK9Ht1NQvesDxa7LUE2.jpg',
                    thumbnail: '/storage/gallery/0FUwDEdw3lSpEcT1cgzhyeK9Ht1NQvesDxa7LUE2.jpg',
                    description: 'Corno Nero, Italy by Luca Zanon, from Unsplash.',
                    alt: 'Landscape photo of mountain with fog.',
                    thumbnailWidth: '220px',
                    h:500,
                },
                {
                    id: 3,
                    src: '/storage/gallery/AeQVNy8bLNCZf84w23FAsPpmWiSoFlZG6ohbuN4c.jpg',
                    thumbnail: '/storage/gallery/AeQVNy8bLNCZf84w23FAsPpmWiSoFlZG6ohbuN4c.jpg',
                    description: 'Remote forest path in Gävle, Sweden by Geran de Klerk, from Unsplash.',
                    alt: 'Low angle photo of pine trees.',
                    thumbnailWidth: '220px',
                    h:500,

                },
            ]
        }
    },
    methods: {
        showGalleryPopup(image) {
            console.log("Image ", image)
            this.currentPopupImage = image;
            this.isGalleryPopupShow = true;
        }
    }
})
</script>
<style>
.my-gallery {
    display: flex;
    margin: 20px 0 0 20px !important;
}

.gallery-thumbnail {
    margin: 0 20px 20px 0 !important;
}

.gallery-thumbnail img {
    width: 200px;
    height: 200px;
    object-fit: cover;
}
</style>
