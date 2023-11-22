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
        :variant="errors.encargado ? 'danger' : 'primary'"
        :message="errors.encargado"
        label="Encargado"
        >
        <o-select
            v-model="form.encargado"
            placeholder="Seleccione un encargado"
        >
            <option v-for="c in empleados" v-bind:key="c.id" :value="c.id">
            {{ c.nombre }}
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
            empleados: [],
            form: {
                nombre: "",
                encargado: "",
            },
            errors: {
                nombre: "",
                encargado: "",
            },
            linea:""
        }
    },
    async mounted() {
        if(this.$route.params.id){
            await this.getLinea();
            console.log(this.linea)
            this.initLinea();
        }
        this.getEmpleados()
    },
    methods: {
        cleanErrorsForm() {
            this.errors.nombre = "";
            this.errors.encargado = "";
        },
        getEmpleados() {
            this.$axios.get("/api/empleado/all").then(res => {
                this.empleados = res.data
            })
        },
        async getLinea() {
            this.linea = await this.$axios.get("/api/linea/"+this.$route.params.id);
            this.linea = this.linea.data
        },
        initLinea(){
            this.form.nombre = this.linea.nombre
            this.form.domicilio = this.linea.domicilio
            this.form.encargado = this.linea.encargado
        },
        submit() {
            console.log(this.form)
            this.cleanErrorsForm()
            if (this.linea == "") {
                return this.$axios
                .post("/api/linea", this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                    if (error.response.data.encargado)
                        this.errors.encargado = error.response.data.encargado[0];

                })
                
            }
            this.$axios
                .patch("/api/linea/"+this.linea.id, this.form)
                .then(res => {
                    console.log(res)
                }).catch((error) => {
                    console.log(error.response.data)

                    if (error.response.data.nombre)
                        this.errors.nombre = error.response.data.nombre[0];

                    if (error.response.data.encargado)
                        this.errors.encargado = error.response.data.encargado[0];
                })
            
        }
    }
}
</script>