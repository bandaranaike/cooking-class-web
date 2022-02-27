<template>
    <app-layout title="Contact us">
        <section class="contact bg-white page-section-ptb">
            <div class="container">

                <div class="section-title text-center">
                    <div class="title-separator">
                        <i class="glyph-icon flaticon-food-27"></i>
                    </div>
                    <h2><span class="text-orange">Contact </span> Us</h2>
                    <p>
                        It would be great to hear from you! If you got any questions
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3">
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="contact-box text-center">
                            <i class="fa fa-map-marker"></i>
                            <h5>Address</h5>
                            <p>162/1 George E. de Silva Mawatha, Kandy 20032</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="contact-box text-center">
                            <i class="fa fa-phone"></i>
                            <h5>Phone</h5>
                            <p>+94777802093</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="contact-box text-center">
                            <i class="fa fa-envelope-o"></i>
                            <h5>Email</h5>
                            <p>info@thotupolaresidence.lk</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-30">
                    <div class="col-lg-12">
                        <div id="formmessage">Success/Error Message Goes Here</div>
                        <form
                            class="form-horizontal"
                            id="contactform"
                            role="form"
                            method="post"
                            action="php/contact-form.php"
                        >
                            <div class="contact-form pt-6 pl-6">
                                <div class="grid grid-cols-1 md:grid-cols-3">

                                    <div class="form-field pr-9">
                                        <i class="fa fa-user"></i>
                                        <input
                                            class="focus:ring-indigo-200 focus:ring-opacity-0 rounded-sm mt-1 block w-full"
                                            id="name"
                                            type="text"
                                            placeholder="Name"
                                            v-model="form.name"
                                        />
                                        <div v-if="errors.name" class="text-red-600 text-xs">
                                            {{ errors.name[0] }}
                                        </div>
                                    </div>

                                    <div class="form-field pr-9">
                                        <i class="fa fa-phone"></i>
                                        <input
                                            class="focus:ring-indigo-200 focus:ring-opacity-0 rounded-sm mt-1 block w-full"
                                            type="text"
                                            placeholder="Phone"
                                            v-model="form.phone"
                                        />
                                        <div v-if="errors.phone" class="text-red-600 text-xs">
                                            {{ errors.phone[0] }}
                                        </div>
                                    </div>

                                    <div class="form-field pr-9">
                                        <i class="fa fa-envelope-o"></i>
                                        <input
                                            class="focus:ring-indigo-200 focus:ring-opacity-0 rounded-sm mt-1 block w-full"
                                            type="email"
                                            placeholder="Email*"
                                            v-model="form.email"
                                        />
                                        <div v-if="errors.email" class="text-red-600 text-xs">
                                            {{ errors.email[0] }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-field pr-9">
                                    <i class="fa fa-pencil"></i>
                                    <textarea
                                        class="focus:ring-indigo-200 focus:ring-opacity-0 rounded-sm mt-1 block w-full"
                                        placeholder="Comment*"
                                        rows="7"
                                        v-model="form.message"
                                    ></textarea>
                                    <div v-if="errors.message" class="text-red-600 text-xs">
                                        {{ errors.message[0] }}
                                    </div>

                                </div>
                                <div class="form-submit mt-10 text-center">
                                    <button
                                        id="submit"
                                        type="button"
                                        value="Send"
                                        class="button"
                                        @click="submitForm"
                                    >
                                        Send Message
                                    </button>
                                </div>
                                <div v-if="response" class="text-center mt-4">
                                      <span class="text-green-600" :class="response.status">
                                        <i class="fa fa-check"></i>
                                        {{ response.message }}
                                      </span>
                                </div>
                            </div>
                        </form>
                        <div v-if="formLoader">
                            <img
                                class="center-block"
                                src="/images/ajax-loader.gif"
                                alt="Loading..."
                            />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--=================================
      contact -->

        <!--=================================
      contact-map -->

        <section class="contact-map">
            <div class="container-fluid">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15830.242996022704!2d80.608553!3d7.290712!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3b354312c462936c!2sThotupola%20Residence!5e0!3m2!1sen!2slk!4v1644911799618!5m2!1sen!2slk"
                    width="100%"
                    height="450"
                    style="border: 0"
                    allowfullscreen="true"
                    loading="lazy"
                    frameborder="0"
                ></iframe>
            </div>
        </section>

        <!--=================================
      contact-map -->
    </app-layout>
</template>
<script>
import axios from "axios";
import AppLayout from "@/Layouts/AppLayout.vue";
import {defineComponent} from "vue";
import {Head, Link} from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        AppLayout,
        Head,
        Link,
    },
    data() {
        return {
            errors: {
                email: null,
                message: null,
                name: null,
                phone: null,
            },
            form: {},
            formLoader: false,
            response: null,
        };
    },
    methods: {
        submitForm() {
            this.formLoader = true;
            axios
                .post(route('contact.create'), this.form)
                .then((r) => {
                    this.response = r.data;
                })
                .catch((e) => {
                    if (e && e.response && e.response.data) {
                        this.errors = e.response.data.errors;
                    }
                })
                .finally(() => {
                    this.formLoader = false;
                });
        },
    },
    watch: {
        form: {
            handler(val) {
                Object.keys(val).map((k) => {
                    this.errors[k] = null;
                });
            },
            deep: true,
        },
    },
});
</script>

