<template>
    <app-layout title="About Us">
        <div class="inner-intro parallax bg-overlay-black-70" style="background-image: url(/images/about-us-bg.jpeg);">
            <div class="container mx-auto">
                <div class="row text-center intro-title">
                    <div class="col-md-12">
                        <h1 class="text-orange">About us</h1>
                        <p class="text-white mb-0">We Know The Secret Of Sri Lankan Foods</p>
                        <ul class="page-breadcrumb">
                            <li><a href="/"><i class="fa fa-home"></i> Home</a> <i class="fa fa-angle-double-right"></i></li>
                            <li><span>about us</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <section class="about white-bg page-section-ptb">
            <div class="container mx-auto max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12">
                <div class="grid grid-cols-2">
                    <div class="pr-6">
                        <div class="custom-content">
                            <h2 class="pb-4"><span class="text-orange mb-20">WHO WE ARE </span> & HISTORY</h2>
                            <p class="text-gray-800 pb-3">We warmly welcome you all to our little home Thotupola Residence situated about five kilometers away from Kandy town. Thotupola
                                residence is a
                                boutique type homestay
                                facing a breath taking view of Mahaweli river and natural landscapes which will provide you the perfect location for relaxing your mind and body.</p>

                            <p class="text-gray-800 pb-3">
                                During the stay, you can visit many attractions around Kandy to feel the Kandyan heritage and take a glimpse of the natural beauty of lovely Sri Lanka. While
                                tasting
                                our specially made dishes you can have a chance to enjoy bird watching.</p>

                            <p class="text-gray-800">
                                Since Thotupola residence is run by a friendly family and located in a calm neighborhood, we assure you that you will experience the warmth of a common Sri
                                Lankan
                                family.</p>
                        </div>
                    </div>
                    <div class="pl-6">
                        <slide-show :slides="slides" :number-text="false"></slide-show>
                    </div>
                </div>
            </div>
        </section>
    </app-layout>
</template>

<script>
import {defineComponent} from 'vue'
import {Head} from '@inertiajs/inertia-vue3';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import AppLayout from "@/Layouts/AppLayout.vue";
import SlideShow from "@/Pages/Component/SlideShow";

export default defineComponent({
    props: ['policy'],

    components: {
        SlideShow,
        Head,
        JetAuthenticationCardLogo,
        AppLayout,
    },

    data() {
        return {
            slides: [
                {
                    src: "/images/about/1.jpg",
                },
                {
                    src: "/images/about/02.jpg",
                    title: "Caption two"
                },
            ]
        }
    }
})
</script>
