<template>
    <form @submit.prevent="submit">
        
        <o-field
            label="Nombre"
            :variant="errors.nombre ? 'danger' : 'primary'"
            :message="errors.nombre"
        >
            <o-input v-model="form.nombre"></o-input>
        </o-field>

        <o-button variant="primary" native-type="submit">
            Enviar
        </o-button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            form: {
                nombre: "",
            },
            errors: {
                nombre: "",
            },
            status:""
        }
    },
    async mounted() {
        if(this.$route.params.id){
            await this.getStatus();
            console.log(this.status)
            this.initStatus();
        }
    },
    methods: {
        cleanErrorsForm() {
            this.errors.nombre = "";
        },

        async getStatus() {
            this.status = await this.$axios.get("/api/status/"+this.$route.params.id);
            this.status = this.status.data
        },
        initStatus(){
            this.form.nombre = this.status.nombre
        },
        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.status == "") {
                return this.$axios
                .post("/api/status", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                })
                
            }
            this.$axios
                .patch("/api/status/"+this.status.id, this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                })
            
        }
    }
}
</script>