<template>
    <list-table :data-items="events" :item-keys="keys" :headers="headers" :actions="actions"></list-table>
</template>

<script>
import {defineComponent} from "vue";
import ListTable from "@/Components/ListTable"

export default defineComponent({
    name: "EventList",
    components: {
        ListTable
    },
    props: {
        events: []
    },
    data() {
        return {
            keys: ["date", "image", "title", "number_of_pax"],
            headers: ["Date", "Images", "Title", "Number of pax", "Actions"],
            actions: [
                {status: "EXPIRED", color: "amber"},
                {status: "ACTIVE", color: "indigo"},
                {status: "INACTIVE", color: "red"},]
        }
    }

})
</script>

<style scoped>

</style>
