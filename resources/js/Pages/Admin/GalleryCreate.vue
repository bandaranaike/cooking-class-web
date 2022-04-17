<template>
    <app-admin-layout title="Create Gallery">
        <div class="grid grid-cols-1 md:grid-cols-2 pt-4 pl-4">
            <jet-input @change="createSlug" :error="errors?.title" label="title" v-model="form.title"></jet-input>
            <jet-input @change="checkSlug" :error="errors?.slug" label="Slug" v-model="form.slug"></jet-input>
        </div>
        <div class="p-4">
            <div class="form-field mb-8">
                <label>Description</label>
                <textarea
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    v-model="form.description"></textarea>
                <div class="text-sm text-red-700" v-if="errors?.description">{{ errors?.description }}</div>
            </div>
            <input type="file" multiple @change="onFilesChange">
            <button @click="submitFormLocal" class="button">Create Gallery</button>
        </div>
    </app-admin-layout>
</template>

<script>
import {defineComponent} from "vue";
import AppAdminLayout from "@/Layouts/AppAdminLayout";
import axios from "axios";
import Forms from "@/Mixing/Forms";
import JetInput from "@/Components/CustomInput";

export default defineComponent({
    components: {AppAdminLayout, JetInput},
    data() {
        return {
            errors: {},
            form: {},
            isSlugAutoGenerating: false,
            slugManuallyChanged: false,
            files: null
        }
    },
    methods: {
        async submitFormLocal() {
            this.submitForm(route('gallery.create'), this.form).then(r => {

            }).catch(e => {
                this.errors = e.response.data.errors
            }).finally(() => {
                location.reload();
            });
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
