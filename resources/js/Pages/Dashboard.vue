<template>
    <app-admin-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="flex gap-6">
                <a class="border border-gray-300 py-4 px-6 rounded" :href="route('review.form')">
                    Create review
                </a>
                <a class="border border-gray-300 py-4 px-6 rounded" :href="route('review.list')">
                    Reviews
                </a>
                <a class="border border-gray-300 py-4 px-6 rounded" :href="route('events.list')">
                    Events
                </a>
                <a class="border border-gray-300 py-4 px-6 rounded" :href="route('events.calendar')">
                    Events Calendar
                </a>
                <a class="border border-gray-300 py-4 px-6 rounded" :href="route('gallery.form')">
                    Gallery create
                </a>
                <a class="border border-gray-300 py-4 px-6 rounded" :href="route('gallery.list')">
                    Gallery Manager
                </a>
            </div>
        </div>
    </app-admin-layout>
</template>

<script>
import {defineComponent} from 'vue'
import AppAdminLayout from '@/Layouts/AppAdminLayout.vue'
import Welcome from '@/Jetstream/Welcome.vue'
import JetNavLink from '@/Jetstream/NavLink.vue'

export default defineComponent({
    components: {
        AppAdminLayout,
        Welcome,
        JetNavLink,
    },
})
</script>
