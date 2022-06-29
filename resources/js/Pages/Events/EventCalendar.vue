<template>
    <app-admin-layout title="Event Calendar">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Event Calendar
            </h2>
        </template>
        <div id="calendar">
            <calendar-view
                :show-date="showDate"
                :items="items"
                @click-date="onClickDay"
                @click-item="onClickItem"
                class="theme-default holiday-us-traditional holiday-us-official">
                <template #header="{ headerProps }">
                    <calendar-view-header
                        :header-props="headerProps"
                        @input="setShowDate"/>
                </template>
            </calendar-view>
        </div>
        <vue-final-modal v-model="showEventCreateModal" max-width="5" classes="modal-container">
            <div class="border-2 border-amber-50 rounded mt-6 max-w-2xl mx-auto bg-gray-50">
                <div class="p-12">
                    <h3 class="mb-6">Event on {{ eventDate }}</h3>
                    <div class="w-full">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    Date
                                </label>
                                <datepicker v-model="pickedDate"
                                            class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight border-gray-200"/>
                                <p class="text-red-500 text-xs italic" v-if="errors">Please fill out this field.</p>
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    Number of Pax
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" v-model="number_of_pax" type="text" placeholder="2">
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-3">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                    Title
                                </label>
                                <input
                                    v-model="title"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                >
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-3">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                    Description
                                </label>
                                <textarea
                                    v-model="description"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                ></textarea>
                            </div>
                        </div>
                        <div class="flex flex-wrap justify-end">
                            <button @click="showEventCreateModal = false" class="bg-red-700 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-4">
                                Cancel
                            </button>
                            <button @click="saveEvent()" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                <inline-loader size="6" :is-loading="isFormSubmitting"></inline-loader>
                                <template v-if="isEventEditing">Update Event</template>
                                <template v-else>Create Event</template>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </vue-final-modal>

        <vue-final-modal v-model="deleteConfirm" max-width="3" classes="modal-container">
            <div class="border-2 border-amber-50 rounded mt-20 max-w-md mx-auto bg-gray-50">
                <div class="p-12">
                    <div class="text-center pb-3"> Are you sure you want to delete this?</div>

                    <div class="flex justify-center">
                        <button @click="deleteEvent()" class="bg-red-700 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-4">
                            <inline-loader size="6" :is-loading="isEventDeleting"></inline-loader>
                            Yes
                        </button>
                        <button @click="deleteConfirm = false" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">
                            No
                        </button>
                    </div>
                </div>
            </div>
        </vue-final-modal>

        <vue-final-modal v-model="showDayEventModal" max-width="5" class="modal-container">
            <div class="border-2 border-amber-50 rounded mt-6 max-w-2xl mx-auto bg-gray-50">
                <div class="p-12">
                    <h3 class="mb-6">Event on {{ viewEvent.date }}
                        <inline-loader :size="9" :is-loading="isViewDataLoading"></inline-loader>
                    </h3>
                    <div class="mb-3"> Title: <span>{{ viewEvent.title }}</span></div>
                    <div class="mb-3"> Description: <span>{{ viewEvent.description }}</span></div>
                    <div class="mb-3"> Number of pax: <span>{{ viewEvent.number_of_pax }}</span></div>
                    <div class="mb-3"> Date: <span>{{ viewEvent.date }}</span></div>

                    <div class="flex justify-end">
                        <button @click="deleteConfirm = true" class="bg-red-700 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-4">
                            Delete
                        </button>
                        <button @click="showDayEventModal = false" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">
                            Close
                        </button>
                        <button @click="editEvent()" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            <inline-loader size="6" :is-loading="isFormSubmitting"></inline-loader>
                            Edit Event
                        </button>
                    </div>
                </div>
            </div>
        </vue-final-modal>
    </app-admin-layout>
</template>

<script>
import {defineComponent} from "vue";
import {CalendarView, CalendarViewHeader} from "vue-simple-calendar"
import AppAdminLayout from "@/Layouts/AppAdminLayout";

import {$vfm, VueFinalModal, ModalsContainer} from 'vue-final-modal'
import Datepicker from "vue3-datepicker";
import moment from 'moment';
import axios from "axios";
import InlineLoader from "@/Components/InlineLoader";

export default defineComponent({
    name: "EventCalendar",
    data: function () {
        return {
            showDate: null,
            clicks: 0,
            timer: null,
            delay: 600,
            showEventCreateModal: false,
            pickedDate: null,
            number_of_pax: 4,
            title: "Cooking Class with Sulochana",
            description: "We will arrange a Sri Lankan food cooking class with a few Australian people. They will do a market visit and select what they want to buy. ",
            isFormSubmitting: false,
            items: [],
            showDayEventModal: false,
            viewEvent: {},
            isViewDataLoading: false,
            isEventEditing: false,
            isEventDeleting: false,
            deleteConfirm: false,
        }
    },
    components: {
        InlineLoader,
        AppAdminLayout,
        CalendarView,
        CalendarViewHeader,
        VueFinalModal,
        ModalsContainer,
        Datepicker
    },
    methods: {
        setShowDate(d) {
            this.showDate = d;
            this.pickedDate = d;
        },
        click() {
            console.log("click")
        },
        doubleClick(day) {
            this.showEventCreateModal = true;
            this.pickedDate = day;
        },
        onClickDay(day, items, event) {
            this.clicks++;
            if (this.clicks === 1) {
                this.timer = setTimeout(() => {
                    this.clicks = 0;
                    this.click()
                }, this.delay)
            } else {
                clearTimeout(this.timer)
                this.doubleClick(day);
                this.clicks = 0;
            }
        },
        saveEvent() {
            const url = this.isEventEditing ? route("events.update", this.viewEvent.public_id) : route("events.create");
            this.isFormSubmitting = true;
            axios.post(url, {
                date: this.eventDate,
                title: this.title,
                description: this.description,
                number_of_pax: this.number_of_pax
            }).then(r => {
                this.getItems();
                setTimeout(() => {
                    this.showEventCreateModal = false;
                }, 300)
            }).catch(e => {
                this.errors = e;
            }).finally(() => {
                this.isFormSubmitting = false
                this.isEventEditing = false
            })
        },
        getItems() {
            axios.get(route("events.items")).then(r => {
                this.items = r.data;
            })
        },
        onClickItem(e) {
            this.isViewDataLoading = true;
            this.getEventData(e.originalItem.publicId)
            this.showDayEventModal = true;
        },
        getEventData(publicId) {
            axios.get(route('event.get-item', publicId)).then(r => {
                this.viewEvent = r.data;
            }).finally(() => this.isViewDataLoading = false)
        },
        editEvent() {
            this.isEventEditing = true;

            this.title = this.viewEvent.title;
            this.description = this.viewEvent.description;
            this.number_of_pax = this.viewEvent.number_of_pax;
            this.eventDate = this.viewEvent.date;
            this.pickedDate = this.viewEvent.date;

            this.showDayEventModal = false;
            this.showEventCreateModal = true;

        },
        deleteEvent() {
            this.isEventDeleting = true;
            axios.delete(route("events.delete", this.viewEvent.public_id)).then(() => {
                this.items = this.items.filter(el => el.publicId !== this.viewEvent.public_id);
            }).finally(() => {
                this.deleteConfirm = false;
                this.isEventDeleting = false;
                this.showDayEventModal = false;
            })
        }
    },
    computed: {
        eventDate(val) {
            return moment(this.pickedDate).format("YYYY-MM-DD")
        }
    },
    mounted() {
        this.getItems();
    }
})
</script>
<style>
::v-deep .modal-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.cv-weeks {
    min-height: 40rem !important;
}
</style>




