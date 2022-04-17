<template>
    <app-admin-layout title="Reviews">
        <div class="not-prose relative bg-slate-400 rounded-xl overflow-hidden dark:bg-slate-100">
            <div class="relative rounded-xl overflow-auto border dark:border-slate-200">
                <div class="shadow-sm overflow-hidden my-8">
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                        <tr>
                            <th class="border-b dark:border-slate-200 font-medium p-4 pl-8 pt-0 pb-3 dark:text-slate-500 text-left">
                                Rating
                            </th>
                            <th class="border-b dark:border-slate-200 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-500 text-left">
                                User
                            </th>
                            <th class="border-b dark:border-slate-200 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-500 text-left">
                                Country
                            </th>
                            <th class="border-b dark:border-slate-200 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-500 text-left">
                                Message
                            </th>
                            <th class="border-b border-slate-200 font-medium p-4 pr-8 pt-0 pb-3 text-slate-400 text-slate-500 text-left">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        <tr v-for="review in reviews">
                            <td class="border-b border-slate-200 p-4 pl-8 text-slate-500">
                                {{ review.rating }}
                            </td>
                            <td class="border-b border-slate-200 p-4 text-slate-500">
                                {{ review.user_name }}
                            </td>
                            <td class="border-b border-slate-200 p-4 text-slate-500">
                                {{ review.user_country }}
                            </td>
                            <td class="border-b border-slate-200 p-4 text-slate-500">
                                {{ review.message }}
                            </td>
                            <td class="border-b border-slate-200 p-4 pr-8 text-slate-500">
                                <button class="bg-gray-500 text-white py-1 px-2 rounded-full mr-2"
                                        v-for="action in actions"
                                        :title="action.status"
                                        @click="changeStatus(review, action.status)"
                                        :class=" review.status === action.status ? `bg-${action.color}-500` : ''">
                                    {{ firstLetter(action.status) }}
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </app-admin-layout>
</template>

<script>
import {defineComponent} from "vue";
import axios from "axios";
import AppAdminLayout from "@/Layouts/AppAdminLayout";
import JetInput from "@/Components/CustomInput";
import Button from "@/Jetstream/Button";

export default defineComponent({
    name: "ReviewList",
    components: {Button, AppAdminLayout},
    props: {
        reviews: []
    },
    data() {
        return {
            actions: [
                {status: "APPROVED", color: "green"},
                {status: "DELETED", color: "orange"},
                {status: "EXPIRED", color: "blue"},
                {status: "PENDING", color: "amber"},
            ]
        }
    },
    methods: {
        firstLetter(word) {
            return word.charAt(0)
        },
        changeStatus(review, status) {
            if (review.status !== status) {
                axios.patch(route('review.change-status'), {
                    status, review_id: review.id
                }).then(res => {
                    review.status = res.data
                })
            }
        }
    }
})
</script>

<style scoped>

</style>
