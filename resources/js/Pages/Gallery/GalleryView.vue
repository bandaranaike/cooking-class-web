<template>
    <app-layout :title="gallery.title">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ gallery.title }}
            </h2>
        </template>

        <vue-picture-swipe :items="gallery.images"></vue-picture-swipe>
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
