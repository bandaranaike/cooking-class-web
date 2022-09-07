<template>
    <app-admin-layout title="Create Gallery">
        <div class="grid grid-cols-1 md:grid-cols-2 pt-4 pl-4">
            <jet-input @change="createSlug" :error="errors?.title" label="Title *" v-model="form.title"></jet-input>
            <jet-input @change="checkSlug" :error="errors?.slug" label="Slug *" v-model="form.slug"></jet-input>
        </div>
        <div class="p-4">
            <div class="form-field mb-8">
                <label>Description</label>
                <textarea
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.description"></textarea>
                <div class="text-sm text-red-700" v-if="errors?.description">{{ errors?.description }}</div>
            </div>
            Images *
            <input type="file" multiple @change="onFilesChange">
            <button @click="submitFormLocal" class="button">
                <inline-loader size="6" :is-loading="isImageUploading"></inline-loader>
                Create Gallery
            </button>
            <span class="ml-3 mt-3" :class="messageClass" v-if="message">{{ message }}</span>
        </div>
    </app-admin-layout>
</template>

<script>
import {defineComponent} from "vue";
import AppAdminLayout from "@/Layouts/AppAdminLayout";
import axios from "axios";
import Forms from "@/Mixing/Forms";
import JetInput from "@/Components/CustomInput";
import InlineLoader from "@/Components/InlineLoader";

export default defineComponent({
    components: {InlineLoader, AppAdminLayout, JetInput},
    data() {
        return {
            errors: {},
            form: {},
            isSlugAutoGenerating: false,
            isImageUploading: false,
            slugManuallyChanged: false,
            files: null,
            message: null,
            messageClass: 'text-green-800',
        }
    },
    methods: {
        async submitFormLocal() {
            if (this.files && this.files.length > 0 && this.form.title && this.form.slug) {
                this.isImageUploading = true;
                this.submitForm(route('gallery.create'), this.form).then(r => {
                    this.message = r.data;
                    this.files = null;
                    this.form = {};
                }).catch(e => {
                    this.message = "There was an error!";
                    this.messageClass = 'text-red-500';
                    console.log(e);
                }).finally(() => {
                    this.isImageUploading = false;
                });
            } else {
                this.message = "Please fill required fields!";
                this.messageClass = 'text-red-500';
            }
        },
        createSlug() {
            if (!this.slugManuallyChanged) {
                this.isSlugAutoGenerating = true;
                axios.post(route('gallery.slug-availability'), {title: this.form.title}).then(r => {
                    this.form.slug = r.data;
                }).catch(e => {

                    console.log(e)
                }).finally(() => {
                    this.isSlugAutoGenerating = false;
                })
            }
        },
        onFilesChange(e) {
            this.files = e.target.files || e.dataTransfer.files;
        },
        checkSlug(e) {
            this.slugManuallyChanged = true;
            console.log("e", e)
        }
    },
    mixins: [Forms]

})
</script>
