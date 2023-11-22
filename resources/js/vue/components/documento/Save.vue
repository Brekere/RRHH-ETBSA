<template>
    <form @submit.prevent="submit">
        
        <o-field
            label="Nombre"
            :variant="errors.nombre ? 'danger' : 'primary'"
            :message="errors.nombre"
        >
            <o-input v-model="form.nombre"></o-input>
        </o-field>

        <o-field
            label="Path"
            :variant="errors.path ? 'danger' : 'primary'"
            :message="errors.path"
        >
            <o-input v-model="form.path"></o-input>
        </o-field>

        <o-field
        :variant="errors.requisito_id ? 'danger' : 'primary'"
        :message="errors.requisito_id"
        label="Requisito"
        >
        <o-select
            v-model="form.requisito_id"
            placeholder="Seleccione un requisito"
        >
            <option v-for="r in requisitos" v-bind:key="r.id" :value="r.id">
            {{ r.nombre }}
            </option>
        </o-select>
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
            requisitos: [],
            form: {
                nombre: "",
                path: "",
                requisito_id: "",
            },
            errors: {
                nombre: "",
                path: "",
                requisito_id: "",
            },
            documento:""
        }
    },
    async mounted() {
        if(this.$route.params.id){
            await this.getDocumento();
            console.log(this.documento)
            this.initDocumento();
        }
        this.getRequisito()
    },
    methods: {
        cleanErrorsForm() {
            this.errors.nombre = "";
            this.errors.path = "";
            this.errors.requisito_id = "";
        },

        getRequisito() {
            this.$axios.get("/api/requisito/all").then(res => {
                this.requisitos = res.data
            })
        },

        async getDocumento() {
            this.documento = await this.$axios.get("/api/documento/"+this.$route.params.id);
            this.documento = this.documento.data
        },

        initDocumento(){
            this.form.nombre = this.documento.nombre
            this.form.path = this.documento.path
            this.form.requisito_id = this.documento.requisito_id
        },

        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.documento == "") {
                return this.$axios
                .post("/api/documento", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                    if (error.response.data.path)
                        this.errors.path = error.response.data.path[0];
                
                    if (error.response.data.requisito_id)
                        this.errors.requisito_id = error.response.data.requisito_id[0];

                })
                
            }
            this.$axios
                .patch("/api/documento/"+this.documento.id, this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                    if (error.response.data.path)
                        this.errors.path = error.response.data.path[0];
                
                    if (error.response.data.requisito_id)
                        this.errors.requisito_id = error.response.data.requisito_id[0];

                })
            
        }
    }
}
</script>