<template>
    <app-layout :title="gallery.title">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{gallery.title}}
            </h2>
        </template>
        <div class="grid grid-cols-1 md:grid-cols-3">

            <div class="gallery-item" v-for="image in  gallery.images">
                Image  {{image}}
                <img :src="`/storage/${image.image}`" :alt="image.title" @click="showGalleryPopup(image)">
            </div>
        </div>

        <x-jet-dialog-modal :show="true">
            <slot name="title">DDDD</slot>
            <x-slot name="content">DDDD</x-slot>
            <div class="grid grid-cols-1">
                currentPopupImage 1    {{currentPopupImage}}
                <img :src="`/storage/${currentPopupImage.image}`" :alt="currentPopupImage.title">
            </div>
            <div class="grid xs:grid-cols-4 sm:grid-cols-6 md:grid-cols-8">
                <div class="gallery-thumb" v-for="image in gallery.images">
                    <img :src="`/storage/${image.image}`" :alt="image.title" @click="showGalleryPopup(image)">
                </div>
            </div>
        </x-jet-dialog-modal>

        <modal :show="true">
            <div class="grid grid-cols-1">
                currentPopupImage 2   {{currentPopupImage}}
                <img :src="`/storage/${currentPopupImage.image}`" :alt="currentPopupImage.title">
            </div>
            <div class="grid xs:grid-cols-4 sm:grid-cols-6 md:grid-cols-8">
                <div class="gallery-thumb" v-for="image in gallery.images">

                    <img :src="`/storage/${image.image}`" :alt="image.title" @click="showGalleryPopup(image)">
                </div>
            </div>
        </modal>
    </app-layout>
</template>

<script>
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";
import {defineComponent} from "vue";
import {Head, Link} from "@inertiajs/inertia-vue3";
import Modal from "@/Jetstream/Modal";
import XJetDialogModal from "@/Jetstream/DialogModal";

export default defineComponent({
    props: {
        gallery: {images: []}
    },
    name: "GalleryView",
    components: {
        XJetDialogModal,
        Modal,
        AppLayout
    },
    data() {
        return {
            currentPopupImage: {},
            isGalleryPopupShow: false
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
