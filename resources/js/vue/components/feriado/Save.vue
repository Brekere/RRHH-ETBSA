<template>
    <form @submit.prevent="submit">
        
        <o-field
            label="fecha"
            :variant="errors.fecha ? 'danger' : 'primary'"
            :message="errors.fecha"
        >
            <o-input v-model="form.fecha"></o-input>
        </o-field>

        <o-field
            label="descripcion"
            :variant="errors.descripcion ? 'danger' : 'primary'"
            :message="errors.descripcion"
        >
            <o-input v-model="form.descripcion"></o-input>
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
                fecha: "",
                descripcion: "",
            },
            errors: {
                fecha: "",
                descripcion: "",
            },
            feriado:""
        }
    },
    async mounted() {
        if(this.$route.params.id){
            await this.getFeriado();
            console.log(this.feriado)
            this.initFeriado();
        }
    },
    methods: {
        cleanErrorsForm() {
            this.errors.fecha = "";
            this.errors.descripcion = "";
        },

        async getFeriado() {
            this.feriado = await this.$axios.get("/api/feriado/"+this.$route.params.id);
            this.feriado = this.feriado.data
        },
        initFeriado(){
            this.form.fecha = this.feriado.fecha
            this.form.descripcion = this.feriado.descripcion
        },
        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.feriado == "") {
                return this.$axios
                .post("/api/feriado", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.fecha)
                        this.errors.fecha = error.response.data.fecha[0];

                    if (error.response.data.descripcion)
                        this.errors.descripcion = error.response.data.descripcion[0];

                })
                
            }
            this.$axios
                .patch("/api/feriado/"+this.feriado.id, this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.fecha)
                        this.errors.fecha = error.response.data.fecha[0];

                    if (error.response.data.descripcion)
                        this.errors.descripcion = error.response.data.descripcion[0];

                })
            
        }
    }
}
</script>