<template>
    <list-table title="Reviews" status-update-url="review.change-status" :actions="actions" :data-items="reviews" :headers="headers" :item-keys="keys"></list-table>
</template>

<script>
import {defineComponent} from "vue";
import axios from "axios";
import AppAdminLayout from "@/Layouts/AppAdminLayout";
import JetInput from "@/Components/CustomInput";
import Button from "@/Jetstream/Button";
import ListTable from "@/Components/ListTable";

export default defineComponent({
    name: "ReviewList",
    components: {ListTable, Button, AppAdminLayout},
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
            ],
            keys: ["rating", "user_name", "user_country", "message"],
            headers: ["Rating", "User", "Country", "Message", "Actions"],
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
