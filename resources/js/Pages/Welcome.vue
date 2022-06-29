<template>
    <app-layout title="Welcome">
        <!-- Slidehow -->
        <slide-show></slide-show>
        <!--End of Slidehow -->

        <!--================== About ===============-->

        <section class="about white-bg text-center">
            <div class="container mx-auto p-8 md:py-12 md:px-24 lg:py-16 lg:px-52 xl:py-20 xl:px-72">
                <div class="title-separator">
                    <i class="glyph-icon flaticon-food-66 fa-5x text-gray-500"></i>
                </div>
                <h2 class="mb-6">
                    <span class="text-orange">Welcome to</span> Sulochanis Kitchen
                </h2>
                <p class="mb-1">Whatever your occasion, We makes it one to remember!</p>
                <p class="mb-6">
                    We provide you with daily self-made bread, sourdough pizza,
                    roasted fish-meat-vegetables and many more. Lorem ipsum dolor sit
                    amet, consectetur adipisicing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                    veniam.
                </p>
                <jet-nav-link :href="route('about-us')" class="button mt-6 lg:mt-8 xl:mt-10">Read More</jet-nav-link>
            </div>
        </section>

        <!--================= About end ================ -->
        <!--================= Events =================== -->

        <section class="our-blog bg-gray-200 page-section-ptb">
            <div class="container mx-auto px-6 md:px-10 xl:px-36">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-16 text-center">
                            <div class="title-separator">
                                <i class="glyph-icon flaticon-chef-hat fa-5x text-gray-500"></i>
                            </div>
                            <h2><span class="text-orange">Upcoming</span> events</h2>
                            <p>The most happening & popular upcoming Events at The Zayka</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="item" v-for="event in events">
                        <div class="blog-entry">
                            <div class="blog-entry-image">
                                <img class="img-fluid" :alt="event.title" :src="`/images/events/${event.image}`"/>
                                <div class="entry-date">{{ toDate(event.date) }}<span>{{ toMonthName(event.date) }}</span></div>
                            </div>
                            <div class="entry-content">
                                <div class="entry-title">
                                    <h3><a href="blog-single.html">{{ event.title }}</a></h3>
                                </div>
                                <div class="entry-meta">
                                    <a><i class="fa fa-user"></i> {{ event.number_of_pax }} pax</a>
                                    <a><i class="fa fa-location-arrow"></i>@thotupola</a>
                                </div>
                                <div class="entry-description">
                                    <p>
                                        {{ event.description }}
                                    </p>
                                    <a href="#"
                                    >Read More <i class="fa fa-angle-double-right"></i
                                    ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--================== Events end ================= -->

        <!--================== testimonials =============== -->

        <section class="testimonials bg-white">
            <div class="page-section-ptb">
                <div class="container mx-auto px-36">
                    <div class="mb-16 text-center">
                        <div class="title-separator">
                            <i class="glyph-icon flaticon-ice-cream-cup-doodle fa-5x text-gray-500"></i>
                        </div>
                        <h2><span class="text-orange">Our </span> testimonials</h2>
                        <p>What Our Happy Clients say about us</p>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2">
                        <div
                            class="testimonial-block left mb-6"
                            v-for="testimonial in testimonials"
                            :key="testimonial.user_name"
                        >
                            <div class="testimonial-avatar">
                                <img
                                    :src="'../storage/' + testimonial.user_image"
                                    :alt="testimonial.user_name"
                                />
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

        <!--================== testimonials =================== -->

        <!--================ reservation form ================= -->

        <section
            class="
        reservation-form
        contact-form
        dark
        page-section-ptb
        parallax
        bg-overlay-black-80
      "
            style="background-image: url('/images/contact-us-bg.jpg')"
        >
            <div class="container mx-auto px-6 md:px-10 lg:px-48">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-16 text-center">
                            <div class="title-separator">
                                <i class="glyph-icon flaticon-food-58 fa-5x text-gray-200"></i>
                            </div>
                            <h2 class="text-white">
                                <span class="text-orange">Sulochans Kitchen</span> Reservation
                            </h2>
                            <p class="text-white">
                                Reserve a cooking class. We will arrange a cooking class for you.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 xl:grid-cols-2">
                    <div class="">
                        <div class="reservation-image form-image">
                            <img class="img-fluid object-fill xl:max-w-fit md:max-w-full" src="/images/contact-us-bg.jpg" alt=""/>
                        </div>
                    </div>
                    <div class="white-bg">
                        <reservation></reservation>
                    </div>
                </div>
            </div>
        </section>

        <!--================================= reservation form  -->
    </app-layout>
</template>

<script>
import {defineComponent} from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import SlideShow from "./Component/SlideShow.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import axios from "axios";
import Reservation from "@/Components/Reservation";

export default defineComponent({
    props: ["testimonials"],
    components: {
        Reservation,
        AppLayout,
        JetNavLink,
        SlideShow,
        Welcome,
    },
    data() {
        return {
            events: []
        }
    },
    mounted() {
        this.getEvents();
    },
    methods: {
        getEvents() {
            axios.get('events/get-list').then(r => {
                this.events = r.data;
            })
        },
        dateSegments(date, options) {
            const dateObject = new Date(date);
            dateObject.setMonth(dateObject.getMonth());

            return dateObject.toLocaleString('en-US', options);
        },
        toMonthName(date) {
            return this.dateSegments(date, {
                month: 'short'
            });
        },
        toDate(date) {
            return this.dateSegments(date, {
                day: "numeric"
            });
        },

    }
});
</script>
