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
            requisito: [],
            form: {
                nombre: "",
            },
            errors: {
                nombre: "",
            },
            requisito:""
        }
    },
    async mounted() {
        if(this.$route.params.id){
            await this.getRequisito();
            console.log(this.requisito)
            this.initRequisito();
        }
    },
    methods: {
        cleanErrorsForm() {
            this.errors.nombre = "";
        },

        async getRequisito() {
            this.requisito = await this.$axios.get("/api/requisito/"+this.$route.params.id);
            this.requisito = this.requisito.data
        },
        initRequisito(){
            this.form.nombre = this.requisito.nombre
        },
        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.requisito == "") {
                return this.$axios
                .post("/api/requisito", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                })
                
            }
            this.$axios
                .patch("/api/requisito/"+this.requisito.id, this.form)
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