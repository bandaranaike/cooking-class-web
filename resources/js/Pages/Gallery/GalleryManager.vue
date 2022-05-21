<template>
    <app-admin-layout title="Mange Galleries">
        <div v-if="updatedGalleryList" class=" p-4 border border-double rounded my-2" v-for="gallery in updatedGalleryList">
            <h3 class="mb-4 relative">{{ gallery.title }}
                <span class="text-lg absolute inline-block cursor-pointer -right-1 rounded-full text-center bg-red-200 text-red-700 w-7 h-7"
                      @click="deleteConfirmation(gallery, 'gallery')">✕</span>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 lg:grid-cols-4 xl:grid-cols-6">
                <div class="relative" v-for="image in gallery.images">
                    <div class="absolute shadow cursor-pointer shadow-gray-800 rounded-full w-6 h-6 text-white bg-red-500 right-1 top-1 text-center"
                         @click="deleteConfirmation(image, 'image')">✕
                    </div>
                    <img class="rounded" :src="`/storage/${image.image}`" :alt="gallery.name">
                </div>
                <div class="bg-gray-300 items-center p-8 w-full flex cursor-pointer rounded" @click="addNewImage(gallery)" title="Add new images">
                    <span class="text-center mx-auto w-14 h-14 rounded-full border border-2 border-gray-50 border-2 text-5xl text-white">+</span>
                </div>
            </div>
        </div>

        <!--        Delete confirmation modal-->
        <vue-final-modal v-model="showDeleteConfirmation" max-width="3" classes="modal-container">
            <div class="border-2 border-amber-50 rounded mt-20 max-w-md mx-auto bg-gray-50">
                <div class="p-10">
                    <div class="text-center pb-3 mb-4"> Are you sure you want to delete this?</div>

                    <div class="flex justify-center">
                        <button @click="deleteItem()" class="bg-red-700 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-4">
                            <inline-loader size="6" :is-loading="isItemDeleting"></inline-loader>
                            Yes
                        </button>
                        <button @click="showDeleteConfirmation = false" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4"> No</button>
                    </div>
                </div>
            </div>
        </vue-final-modal>

        <!--        New Images upload modal-->
        <vue-final-modal v-model="showAddImagesToGallery">
            <div class="border-2 border-amber-50 p-10 rounded mt-20 max-w-md mx-auto bg-gray-50">
                <input class="mb-3" type="file" multiple @change="onFilesChange">
                <div class="flex justify-center">
                    <button @click="uploadImages()" class="bg-red-700 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-4">
                        <inline-loader size="6" :is-loading="isImageUploading"></inline-loader>
                        Upload images
                    </button>
                    <span class="mr-3 mt-3" :class="messageClass" v-if="message">{{ message }}</span>
                    <button @click="showAddImagesToGallery = false" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4"> Cancel</button>
                </div>
            </div>
        </vue-final-modal>
    </app-admin-layout>
</template>

<script>
import {defineComponent} from 'vue'
import {Head} from '@inertiajs/inertia-vue3';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import SlideShow from "@/Pages/Component/SlideShow";
import AppAdminLayout from "@/Layouts/AppAdminLayout";
import InlineLoader from "@/Components/InlineLoader";
import {VueFinalModal} from 'vue-final-modal'
import Forms from "@/Mixing/Forms";

export default defineComponent({
    props: ['galleries'],

    components: {
        AppAdminLayout,
        SlideShow,
        Head,
        JetAuthenticationCardLogo,
        InlineLoader,
        VueFinalModal
    },
    data() {
        return {
            deletingItem: null,
            deletingUrl: null,
            imageAddingGallery: null,
            isItemDeleting: false,
            isImageUploading: false,
            showAddImagesToGallery: false,
            showDeleteConfirmation: false,
            updatedGalleryList: [],
            files: null,
            form: {},
            message: null,
            messageClass: 'text-green-500',
        }
    },
    methods: {
        addNewImage(gallery) {
            this.showAddImagesToGallery = true;
            this.imageAddingGallery = gallery;
        },

        deleteConfirmation(item, type) {
            this.deletingUrl = type === 'image' ? 'gallery.image-delete' : 'gallery.delete';
            this.deletingItem = item;
            this.showDeleteConfirmation = true;
        },

        deleteItem() {
            this.isItemDeleting = true;
            axios.delete(route(this.deletingUrl, this.deletingItem?.public_id)).then(() => {
                this.getGalleries();
                this.showDeleteConfirmation = false;
            }).finally(() => this.isItemDeleting = false)
        },

        getGalleries() {
            axios.get(route("gallery.get-list")).then(r => this.updatedGalleryList = r.data)
        },

        onFilesChange(e) {
            this.files = e.target.files || e.dataTransfer.files;
        },

        uploadImages() {
            if (this.files && this.files.length > 0) {
                this.isImageUploading = true;
                this.submitForm(route('gallery.upload-image', this.imageAddingGallery.public_id), this.form).then(r => {
                    this.message = r.data;
                    this.files = null;
                    this.getGalleries();
                    this.isImageUploading = false;
                    this.showAddImagesToGallery = false;
                }).catch(e => {
                    this.message = "There was an error!";
                    this.messageClass = 'text-red-500';
                    console.log(e);
                }).finally(() => {
                    // location.reload();
                });
            }
        }
    },
    mounted() {
        this.updatedGalleryList = this.galleries;
    },
    mixins: [Forms]
})
</script>
