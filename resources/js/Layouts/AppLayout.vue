<template>
    <div>
        <Head :title="title"/>

        <jet-banner/>

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('home')">
                                    <jet-application-mark class="block h-9 w-auto"/>
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-4 sm:-my-px sm:ml-6 sm:flex">
                                <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </jet-nav-link>
                            </div>
                            <div class="hidden space-x-4 sm:-my-px sm:ml-4 sm:flex">
                                <jet-nav-link :href="route('gallery.show')" :active="route().current('gallery.show')">
                                    Gallery
                                </jet-nav-link>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="hidden space-x-4 sm:-my-px sm:ml-4 sm:flex">
                                <jet-nav-link :href="route('about-us')" :active="route().current('about-us')">
                                    About Us
                                </jet-nav-link>
                            </div>
                            <div class="hidden space-x-4 sm:-my-px sm:ml-4 sm:flex">
                                <jet-nav-link :href="route('contact.form')" :active="route().current('contact.form')">
                                    Contacts
                                </jet-nav-link>
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">

                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"/>
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}"
                     class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <jet-responsive-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </jet-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">

                        <div class="mt-3 space-y-1">

                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>

            <!--================== footer -->
            <footer class="">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 py-12">
                        <div class="">
                            <div class="logo-sec">
                                <div class="mb-4">
                                    <Link :href="route('home')" class="mb-6">
                                        <jet-application-mark class="block h-16 w-auto"/>
                                    </Link>
                                </div>
                                <p class="text-black my-3">Sulochana's Kitchen is a subsidiary of Thotupola Residence. Please go and see the website
                                    <a href="https://thotupolaresidence.lk" target="_blank">https://thotupolaresidence.lk</a></p>
                                <div class="contact">
                                    <p class="text-black mb-2"><i class="fa fa-map-marker text-red-700 mr-3"></i>162/1 George E. de Silva Mawatha, Kandy 20032</p>
                                    <p class="text-black mb-2"><i class="fa fa-phone text-red-700 mr-3"></i>(94) 7778 02093</p>
                                    <p class="text-black mb-2"><a class="text-black" href="mailto:info@thotupolaresidence.lk">
                                        <i class="fa fa-envelope-o text-red-700 mr-3"></i>info@thotupolaresidence.lk
                                    </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="opening-time">
                                <h4 class="text-black mb-10"><span class="text-orange">Open</span> time</h4>
                                <ul>
                                    <li>Mon-Friday <span class="text-end">8am - 2pm </span></li>
                                    <li>Saturday <span>10am - 4pm</span></li>
                                    <li>Sunday <span>11am - 4pm</span></li>
                                    <li class="close-day"><span class="graph-icon flaticon-closed-sign fa-5x text-red-500"></span><em class="text-orange"> On public holidays</em>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="footer-gallery">
                                <h4 class="text-black"><span class="text-orange">Photo</span> Gallery</h4>
                                <ul>
                                    <li><img class="img-fluid" src="images/gallery/01.jpg" alt=""></li>
                                    <li><img class="img-fluid" src="images/gallery/02.jpg" alt=""></li>
                                    <li><img class="img-fluid" src="images/gallery/03.jpg" alt=""></li>
                                    <li><img class="img-fluid" src="images/gallery/04.jpg" alt=""></li>
                                    <li><img class="img-fluid" src="images/gallery/05.jpg" alt=""></li>
                                    <li><img class="img-fluid" src="images/gallery/06.jpg" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 py-6 border-t text-sm">
                        <div class="">
                            <div class="copyright">
                                <p class="text-black"> &copy;Copyright <span id="copyright"> </span>
                                    All right reserved by The Thotupola Residence.
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            Designed by <a class="text-orange" href="https://sevensbay.com" target="_blank"> Sevens Bay</a>
                        </div>
                    </div>

                </div>
            </footer>
            <!--================== footer -->
        </div>
    </div>
</template>

<script>
import {defineComponent} from 'vue'
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
import JetBanner from '@/Jetstream/Banner.vue'
import JetDropdown from '@/Jetstream/Dropdown.vue'
import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
import JetNavLink from '@/Jetstream/NavLink.vue'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
import {Head, Link} from '@inertiajs/inertia-vue3';

export default defineComponent({
    props: {
        title: String,
    },

    components: {
        Head,
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        Link,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        }
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },

        logout() {
            this.$inertia.post(route('logout'));
        },
    }
})
</script>
