<template>
    <app-layout title="Welcome">
        <!--=================================
        testimonials -->

        <section class="testimonials max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="object-bottom-top">
                <div class="object-right">
                    <img class="img-fluid" src="/images/object/05.png" alt="">
                </div>
            </div>
            <div class="page-section-ptb">
                <div class="container">

                    <div class="section-title text-center">
                        <div class="title-separator">
                            <i class="glyph-icon flaticon-food-27"></i>
                        </div>
                        <h2><span class="text-orange">Our </span> testimonials</h2>
                        <p>What Our Happy Clients say about us</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        <div class="testimonial-block left" v-for="testimonial in testimonials">
                            <div class="testimonial-avatar">
                                <img :src="'../storage/' + testimonial.user_image" :alt="testimonial.user_name">
                            </div>
                            <div class="testimonial-info clearfix">
                                <strong>{{ testimonial.user_name }}</strong>
                                <span>{{ testimonial.user_country }}</span>
                                <p>{{ testimonial.message }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--=================================
        testimonials -->
    </app-layout>
</template>

<script>
import {defineComponent} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Welcome from '@/Jetstream/Welcome.vue'

export default defineComponent({
    props: ["testimonials"],
    components: {
        AppLayout,
        Welcome,
    },
})
</script>
