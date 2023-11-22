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
            cargo:""
        }
    },
    async mounted() {
        if(this.$route.params.id){
            await this.getCargo();
            console.log(this.cargo)
            this.initCargo();
        }
    },
    methods: {
        cleanErrorsForm() {
            this.errors.nombre = "";
        },

        async getCargo() {
            this.cargo = await this.$axios.get("/api/cargo/"+this.$route.params.id);
            this.cargo = this.cargo.data
        },
        initCargo(){
            this.form.nombre = this.cargo.nombre
        },
        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.cargo == "") {
                return this.$axios
                .post("/api/cargo", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                })
                
            }
            this.$axios
                .patch("/api/cargo/"+this.cargo.id, this.form)
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