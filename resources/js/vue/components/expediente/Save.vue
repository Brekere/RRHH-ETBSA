<template>
    <form @submit.prevent="submit">
        
        <o-field
            label="Path"
            :variant="errors.path ? 'danger' : 'primary'"
            :message="errors.path"
        >
            <o-input v-model="form.path"></o-input>
        </o-field>

        <o-field
        :variant="errors.documento_id ? 'danger' : 'primary'"
        :message="errors.documento_id"
        label="Categoría"
        >
        <o-select
            v-model="form.documento_id"
            placeholder="Seleccione una categoría"
        >
            <option v-for="d in documentos" v-bind:key="d.id" :value="d.id">
            {{ d.nombre }}
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
            documentos: [],
            form: {
                path: "",
                documento_id: "",
            },
            errors: {
                path: "",
                documento_id: "",
            },
            expediente:""
        }
    },
    async mounted() {
        if(this.$route.params.id){
            await this.getExpediente();
            console.log(this.expediente)
            this.initExpediente();
        }
        this.getDocumento()
    },
    methods: {
        cleanErrorsForm() {
            this.errors.path = "";
            this.errors.documento_id = "";
        },
        getDocumento() {
            this.$axios.get("/api/documento/all").then(res => {
                this.documentos = res.data
            })
        },
        async getExpediente() {
            this.expediente = await this.$axios.get("/api/expediente/"+this.$route.params.id);
            this.expediente = this.expediente.data
        },
        initExpediente(){
            this.form.path = this.expediente.path
            this.form.documento_id = this.expediente.documento_id
        },
        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.expediente == "") {
                return this.$axios
                .post("/api/expediente", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.path)
                        this.errors.path = error.response.data.path[0];

                    if (error.response.data.documento_id)
                        this.errors.documento_id = error.response.data.documento_id[0];

                })
                
            }
            this.$axios
                .patch("/api/expediente/"+this.expediente.id, this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.path)
                        this.errors.path = error.response.data.path[0];

                    if (error.response.data.documento_id)
                        this.errors.documento_id = error.response.data.documento_id[0];
                })
            
        }
    }
}
</script>