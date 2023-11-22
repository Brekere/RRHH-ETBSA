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
            motivo:""
        }
    },
    async mounted() {
        if(this.$route.params.id){
            await this.getMotivo();
            console.log(this.motivo)
            this.initMotivo();
        }
    },
    methods: {
        cleanErrorsForm() {
            this.errors.nombre = "";
        },

        async getMotivo() {
            this.motivo = await this.$axios.get("/api/motivo/"+this.$route.params.id);
            this.motivo = this.motivo.data
        },
        initMotivo(){
            this.form.nombre = this.motivo.nombre
        },
        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.motivo == "") {
                return this.$axios
                .post("/api/motivo", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                })
                
            }
            this.$axios
                .patch("/api/motivo/"+this.motivo.id, this.form)
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