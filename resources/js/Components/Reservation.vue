<template>
    <form>

        <h3 class="mb-8">Reservation form</h3>

        <div class="form-field"><i class="fa fa-pencil"></i>
            <popper class="light" arrow :content="errors.name" :show="errors.name !== ''">

                <input
                    class="web placeholder"
                    type="text"
                    placeholder="Your Name *"
                    v-model="form.name"
                />
            </popper>
        </div>

        <div class="form-field">
            <i class="fa fa-phone"></i>
            <input
                class="web placeholder"
                type="text"
                placeholder="Phone Number"
                v-model="form.phone"
            />
        </div>

        <div class="form-field"><i class="fa fa-envelope-o"></i>
            <popper class="light" arrow :content="errors.email" :show="errors.email !== ''">

                <input
                    class="web placeholder"
                    type="text"
                    placeholder="Your Email *"
                    v-model="form.email"
                />
            </popper>
        </div>

        <div class="form-field" id="datepicker">
            <i class="fa fa-calendar add-on"></i>
            <input
                data-format="yyyy-MM-dd"
                type="text"
                placeholder="Select date"
                v-model="form.date"
            />
        </div>

        <div class="form-field" id="timepicker">
            <i class="fa fa-clock-o icon-time add-on"></i>
            <input
                data-format="hh:mm:ss"
                type="text"
                placeholder="Select time"
                v-model="form.time"
            />
        </div>

        <div class="form-field">
            <input
                class="web placeholder"
                type="text"
                placeholder="Number of pax"
                v-model="form.number_of_pax"
            />
        </div>

        <div class="form-field">
            <i class="fa fa-comment-o"></i>
            <textarea
                v-model="form.comment"
                class="input-message placeholder"
                placeholder="Comment"
                rows="2"
            ></textarea>
        </div>

        <div class="submit-button">
            <a class="button cursor-pointer" @click="submitForm">Book A Cooking Class</a>
            <inline-loader :is-loading="isFormSubmitting"></inline-loader>
            <div v-if="isBooked" class="text-green-700 ml-3 inline-block"><i class="fa fa-check-circle"></i> Booked !</div>
            <div v-if="validationError" class="text-red-700 mt-3 inline-block"><i class="fa fa-warning"></i> {{ validationError }}</div>
            <div class="mt-3">Is all about Sri Lankan Foods. Learn and Enjoy them with Sulochana</div>
        </div>
    </form>
</template>

<script>
import {defineComponent} from 'vue'
import Popper from "vue3-popper";
import InlineLoader from "@/Components/InlineLoader";

export default defineComponent({
    name: "Reservation",
    components: {
        InlineLoader,
        Popper
    },
    data() {
        return {
            isFormSubmitting: false,
            isBooked: false,
            errors: {
                name: "",
                email: ""
            },
            form: {
                name: "",
                email: "",
                phone: "",
                date: "",
                time: "",
                number_of_pax: "",
                comment: ""
            },
            validationError: null
        }
    },
    methods: {
        submitForm() {
            this.isBooked = false;
            this.validationError = null;
            if (!this.form.name || this.form.name === "") {
                this.errors.name = "Name field is required!"
            } else if (!this.form.email && this.form.email === "") {
                this.errors.email = "Email field is required"
            } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.form.email)) {
                this.errors.email = "Please enter valid email address"
            } else {
                this.isFormSubmitting = true;
                axios.post(route("reservation.create"), this.form).then(r => {
                    this.isBooked = true
                    this.form = {}
                    this.errors = {}
                }).catch(e => {
                    this.validationError = e.message;
                }).finally(() => this.isFormSubmitting = false)
            }
        }
    },
    watch: {
        "form.email": function () {
            this.errors.email = ""
        },
        "form.name": function () {
            this.errors.name = ""
        }
    }
})
</script>

<style>
.light {
    min-width: calc(100% + 24px);
    --popper-theme-background-color: #ffffff;
    --popper-theme-background-color-hover: #ffffff;
    --popper-theme-text-color: #9a1b0a;
    --popper-theme-border-width: 1px;
    --popper-theme-border-style: solid;
    --popper-theme-border-color: #eeeeee;
    --popper-theme-border-radius: 6px;
    --popper-theme-padding: 15px 25px;
    --popper-theme-box-shadow: 0 6px 30px -6px rgba(0, 0, 0, 0.25);
}
</style>
