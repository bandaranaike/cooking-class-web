<template>
    <app-admin-layout title="Create new review">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create new review
            </h2>
        </template>

        <div class="py-12">
            <form action="">
                <div class="grid grid-cols-1 md:grid-cols-3 pt-5 pl-5">
                    <div class="form-field pb-5 pr-5">
                        <label>Rating</label>
                        <star-rating v-model:rating="form.rating" star-size="40" :show-rating="false"></star-rating>
                    </div>
                    <div class="form-field pb-5 pr-5">
                        <label>Client Name</label>
                        <input
                            class="border-gray-400 focus:ring-indigo-200 focus:ring-opacity-0 rounded-sm mt-1 block w-full"
                            id="userName"
                            type="text"
                            placeholder="User name"
                            v-model="form.user_name"
                        />
                        <div v-if="errors?.user_name" class="text-red-600 text-xs">
                            {{ errors?.user_name[0] }}
                        </div>
                    </div>
                    <div class="form-field  pb-5 pr-5">
                        <label>Date</label>
                        <datepicker v-model="form.date"
                                    class="border-gray-400 focus:ring-indigo-200 focus:ring-opacity-0 rounded-sm mt-1 block w-full"/>
                        <div v-if="errors?.date" class="text-red-600 text-xs">
                            {{ errors?.date[0] }}
                        </div>
                    </div>
                    <div class="form-field  pb-5 pr-5">
                        <label>Client's Image</label>
                        <input type="file" @change="onFileChange"
                               class="border-gray-400 focus:ring-indigo-200 focus:ring-opacity-0 rounded-sm mt-1 block w-full"/>
                        <div v-if="errors?.user_image" class="text-red-600 text-xs">
                            {{ errors?.user_image[0] }}
                        </div>
                    </div>
                    <div class="form-field  pb-5 pr-5">
                        <label>Client's country</label>
                        <input type="text" v-model="form.user_country"
                               class="border-gray-400 focus:ring-indigo-200 focus:ring-opacity-0 rounded-sm mt-1 block w-full"/>
                        <div v-if="errors?.user_country" class="text-red-600 text-xs">
                            {{ errors?.user_country[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-field pl-5 pb-5 pr-5">
                    <label>Comment</label>
                    <textarea
                        class="border-gray-400 focus:ring-indigo-200 focus:ring-opacity-0 rounded-sm mt-1 block w-full"
                        placeholder="Comment*"
                        rows="7"
                        v-model="form.message"
                    ></textarea>
                    <div v-if="errors?.message" class="text-red-600 text-xs">
                        {{ errors?.message[0] }}
                    </div>
                </div>
                <div class="form-submit mt-5 mb-10 text-center ">
                    <button
                        id="submit"
                        type="button"
                        value="Send"
                        class="button"
                        @click="submitForm"
                    >
                        Send Message
                    </button>
                    <img v-if="formLoader"
                         class="inline-block mx-5"
                         src="/images/loader.png"
                         alt="Loading..."
                    />
                    <div v-else class="inline-block" style="width: 3.5rem"></div>
                </div>
                <div class="text-center pb-4 text-green-900">{{ response }}</div>
            </form>
        </div>
    </app-admin-layout>
</template>
<script setup>
import axios from "axios";
import AppAdminLayout from "@/Layouts/AppAdminLayout";
import StarRating from 'vue-star-rating'
import Datepicker from 'vue3-datepicker'
import {ref, watch, reactive} from 'vue'


let errors = ref({
    user_name: null
})
const form = ref({
    rating: 1,
    message: 'test',
    user_name: 'Eranda',
    user_country: 'Sri Lanka',
    date: new Date()
})

const newForm = new FormData();


let formLoader = ref(false);
let response = ref("");

function onFileChange(e) {
    errors.value.user_image = null;
    let files = e.target.files || e.dataTransfer.files;
    if (files[0]) {
        newForm.append('user_image', files[0]);
    }
}

async function fillTheForm() {
    for (let k in form.value) {
        newForm.append(k, form.value[k]);
    }
}

async function submitForm(event) {
    formLoader.value = true;
    await fillTheForm();
    await axios.post(route('review.create'), newForm).then((r) => {
        response.value = r.data;
    }).catch((e) => {
        if (e && e.response && e.response.data) {
            errors.value = e.response.data.errors;
        }
    }).finally(() => {
        formLoader.value = false;
    })
}

watch(form, (v) => {
    Object.keys(v).map((k) => {
        if (errors && errors.value) {
            errors.value[k] = null;
        }
    });
}, {deep: true});
</script>

