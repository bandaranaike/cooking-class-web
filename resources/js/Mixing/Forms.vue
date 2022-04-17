<script>
import axios from "axios";
import {defineComponent} from "vue";

export default defineComponent({
    methods: {
        async submitForm(url, form) {
            await this.prepareForm(form)
            return axios.post(url, this.formData);
        },
        async prepareForm(form) {
            for (let name in form) {
                this.formData.append(name, form[name]);
            }
            for (let i = 0; i < this.files.length; i++) {
                this.formData.append('images[]', this.files[i])
            }
        }
    },
    data() {
        return {
            isFormSubmitting: false,
            formData: new FormData()
        }
    },
    watch: {
        form: {
            handler(v) {
                Object.keys(v).map((k) => {
                    if (this.errors && this.errors.value) {
                        this.errors[k] = null;
                    }
                })
            },
            deep: true
        },
    }
})
</script>

