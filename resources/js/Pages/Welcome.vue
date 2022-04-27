<template>
    <app-layout title="Welcome">
        <!-- Slidehow -->
        <slide-show></slide-show>
        <!--End of Slidehow -->

        <!--================== About ===============-->

        <section class="about white-bg">
            <div class="page-section-ptb">
                <div class="container mx-auto px-36">
                    <div class="row position-relative z-index-1">
                        <div class="col-lg-12 col-md-12">
                            <div class="section-title text-center">
                                <div class="title-separator">
                                    <i class="glyph-icon flaticon-food-27"></i>
                                </div>
                                <h2>
                                    <span class="text-orange">Welcome to</span> Sulochanis Kitchen
                                </h2>
                                <p>Whatever your occasion, We makes it one to remember!</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mx-auto px-36">
                        <p class="mb-6">
                            We provide you with daily self-made bread, sourdough pizza,
                            roasted fish-meat-vegetables and many more. Lorem ipsum dolor sit
                            amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam.
                        </p>
                        <jet-nav-link :href="route('about-us')" class="button mt-10">Read More</jet-nav-link>
                    </div>
                </div>
            </div>
        </section>

        <!--================= About end ================ -->
        <!--================= Events =================== -->

        <section class="our-blog gray-bg page-section-ptb">
            <div class="container mx-auto px-36">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <div class="title-separator">
                                <i class="glyph-icon flaticon-food-27"></i>
                            </div>
                            <h2><span class="text-orange">Upcoming</span> events</h2>
                            <p>The most happening & popular upcoming Events at The Zayka</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="item" v-for="event in events">
                        <div class="blog-entry">
                            <div class="blog-entry-image">
                                <img class="img-fluid" :alt="event.title" :src="`/storage/${event.image}`"/>
                                <div class="entry-date">{{ event.day }}<span>{{ event.month }}</span></div>
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
                    <div class="section-title text-center">
                        <div class="title-separator">
                            <i class="glyph-icon flaticon-food-27"></i>
                        </div>
                        <h2><span class="text-orange">Our </span> testimonials</h2>
                        <p>What Our Happy Clients say about us</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3">
                        <div
                            class="testimonial-block left"
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
            style="background-image: url(images/bg/02.jpg)"
        >
            <div class="container mx-auto px-36">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <div class="title-separator">
                                <i class="glyph-icon flaticon-food-27"></i>
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
                <div class="grid grid-cols-2">
                    <div class="">
                        <div class="reservation-image form-image">
                            <img class="img-fluid" src="images/event/07.jpg" alt=""/>
                        </div>
                    </div>
                    <div class="white-bg">
                        <form class="row">
                            <div class="col-lg-12 col-md-12">
                                <h3 class="mb-30">Reservation form</h3>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-field">
                                    <i class="fa fa-pencil"></i>
                                    <input
                                        class="web placeholder"
                                        type="text"
                                        placeholder="Full Name"
                                        name="web"
                                    />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-field">
                                    <i class="fa fa-phone"></i>
                                    <input
                                        class="web placeholder"
                                        type="text"
                                        placeholder="Phone Number"
                                        name="web"
                                    />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-field">
                                    <i class="fa fa-envelope-o"></i>
                                    <input
                                        class="web placeholder"
                                        type="text"
                                        placeholder="Your Email"
                                        name="web"
                                    />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-field" id="datepicker">
                                    <i class="fa fa-calendar add-on"></i>
                                    <input
                                        data-format="yyyy-MM-dd"
                                        type="text"
                                        placeholder="Select date"
                                    />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-field" id="timepicker">
                                    <i class="fa fa-clock-o icon-time add-on"></i>
                                    <input
                                        data-format="hh:mm:ss"
                                        type="text"
                                        placeholder="Select time"
                                    />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-field">
                                    <div class="selected-box">
                                        <select>
                                            <option value="Person">Person</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="2">More then 2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="form-field">
                                    <i class="fa fa-comment-o"></i>
                                    <textarea
                                        class="input-message placeholder"
                                        placeholder="Comment*"
                                        rows="2"
                                        name="message"
                                    ></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="submit-button">
                                    <a class="button" href="#">Book A Table</a>
                                    <span>Is all about good food. Enjoy our decious food</span>
                                </div>
                            </div>
                        </form>
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

export default defineComponent({
    props: ["testimonials"],
    components: {
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
        }
    }
});
</script>
